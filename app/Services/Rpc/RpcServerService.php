<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\5\8 0008
 * Time: 23:07
 */
namespace App\Services\Rpc;

use Hprose\Filter\JSONRPC\ServiceFilter;
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
        $rpcConf = config('rpc');
        if (empty($rpcConf['uri'])) {
            throw new \Exception('配置监听地址格式有误', 500);
        }
        $method = $rpcConf['method'];
        if(empty($method)){
            throw new \Exception('配置服务方法不存在', 500);
        }
        //2、调用中间件
        $this->server->addInvokeHandler(function ($name, array &$args, \stdClass $context, \Closure $next) {
            //3、验证数据格式是否正确,以及判断方法
            //service:method:params

            var_dump($args);
            $result = $next($name, $args, $context);
            return $result;
        });
        //4、解析代码并执行添加服务
        foreach ($method as $item)
        {
            //开始注册服务方法
            $class = $item['service'];
            $alias = $item['alias'];
            $classObj = new $class;
            $this->server->addFilter(new ServiceFilter());
            $this->server->addInstanceMethods($classObj, '', $alias);
        }
        //5、监听服务
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
