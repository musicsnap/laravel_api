<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\5\8 0008
 * Time: 23:07
 */
namespace App\Services\Rpc;

use Hprose\Filter\JSONRPC\ServiceFilter;
use function Hprose\Future\isFuture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RpcServerService
{
    private $server;

    public function __construct(){
        $this->server = new RpcServer();
        $this->server->setErrorTypes(E_ALL);
        $this->server->setDebugEnabled();
        //1、rpc 服务的构建（Hprose,swoole,rabbitmq,socket,php-rpc,json-rpc,grpc,thrit）
        $this->server->onSendError = function(&$error, \stdClass $context) {
            Log::info($error);
        };
        $this->server->onError = function($error, \stdClass $context) {

        };
        $this->server->onAccept = function(\stdClass $context) {

        };
        //2、判断服务配置
        $rpcConf = config('rpc');
        if (empty($rpcConf['uri'])) {
            throw new \Exception('配置监听地址格式有误', 500);
        }
        $services = $rpcConf['registries'];
        if(empty($services)){
            throw new \Exception('配置服务方法不存在', 500);
        }
        //3、调用中间件
        $this->server->addInvokeHandler(function ($name, array &$args, \stdClass $context, \Closure $next) {
            //service:method:params
            $data = $args[0];
            if(!is_array($data)) throw new \Exception('参数不正确!', 500);
            if(empty($data['service'])) throw new \Exception('服务名称不正确!', 500);
            if(empty($data['method'])) throw new \Exception('服务方法不正确!', 500);
            //这边需要参数判读处理
            $result = $next($name, $args, $context);
            return $result;
        });
        //4、解析代码并执行添加服务
        foreach ($services as $item)
        {
            //开始注册服务方法
            $class = $item['service'];
            $alias = $item['alias'];
            $classObj = new $class;
            $this->server->addInstanceMethods($classObj, '', $alias);
        }
        //5、Json过滤
        $this->server->addFilter(new ServiceFilter());
        //6、监听服务
        $this->server->addListener($rpcConf['uri']);
    }

    public function getServer()
    {
        return $this->server;
    }

    public function runServer()
    {
        $this->server->start();
    }

}
