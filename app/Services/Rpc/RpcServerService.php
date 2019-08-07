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
    public function __construct(){
        $server = new RpcServer();
        $server->setErrorTypes(E_ALL);
        $server->setDebugEnabled();
        //1、rpc 服务的构建（Hprose,swoole,rabbitmq,socket,php-rpc,json-rpc,grpc,thrit）
        $server->onSendError = function(&$error, \stdClass $context) {
            Log::info($error);
        };
        $rpcConf = config('rpc');
        if (empty($rpcConf['uri'])) {
            throw new \Exception('配置监听地址格式有误', 500);
        }
        //支持jsonRpc
        $server->addFilter(new ServiceFilter());

        //2、调用中间件
        $server->addInvokeHandler(function ($name, array &$args, \stdClass $context, \Closure $next) {
            //3、验证数据格式是否正确
            //service:method:params

            var_dump($args);
            $result = $next($name, $args, $context);
            return $result;
        });
        //4、解析代码并执行添加服务

//        $server->addFunction('','');



        $server->start();
    }

}
