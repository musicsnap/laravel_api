<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\5\8 0008
 * Time: 23:07
 */
namespace App\Services\Rpc;

use Hprose\Socket\Service;
use Illuminate\Support\Facades\Log;

class RpcServerService
{
    public function __construct(){
        $server = new Service();
        //1、rpc 服务的构建（Hprose,swoole,rabbitmq,socket）
        $server->onSendError = function(&$error, \stdClass $context) {
            Log::info($error);
        };
        $server->onBeforeInvoke = function ($name, &$args, $byref, \stdClass $context) {

        };
        $server->onAfterInvoke  = function ($name, &$args, $byref, &$result, \stdClass $context) {

        };
        //调用中间件
        $server->addInvokeHandler(function ($name, array &$args, \stdClass $context, \Closure $next) {
            //验证数据格式是否正确

            $result = $next($name, $args, $context);
            return $result;
        });
        //2、响应客户端请求（解析参数）

        //3、按照约定的命名规则去定位代码位置
        $rpcConf = config('rpc');
        if (!is_array($rpcConf)) {
            throw new \Exception('配置监听地址格式有误', 500);
        }
        var_dump($server);

        return $server;
    }

}
