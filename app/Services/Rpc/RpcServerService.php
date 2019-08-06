<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\5\8 0008
 * Time: 23:07
 */
namespace App\Services\Rpc;

use Hprose\Filter\JSONRPC\ServiceFilter;
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
        //支持jsonRpc
        $server->addFilter(new ServiceFilter());

        //2、调用中间件
        $server->addInvokeHandler(function ($name, array &$args, \stdClass $context, \Closure $next) {
            //验证数据格式是否正确
            //service:method:params

            $result = $next($name, $args, $context);
            return $result;
        });
        //4、响应客户端请求（解析参数）

        //5、按照约定的命名规则去定位代码位置
        $routeFilePath = base_path('routes/rpc.php');
        if (!file_exists($routeFilePath)) {
            throw new \Exception('缺少rpc路由文件', 500);
        }
        require $routeFilePath;

        $server->addFunction('','');

        $rpcConf = config('rpc');
        if (!is_array($rpcConf)) {
            throw new \Exception('配置监听地址格式有误', 500);
        }

        $server->start();
    }

}
