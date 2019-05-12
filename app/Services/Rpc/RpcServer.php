<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\5\8 0008
 * Time: 23:07
 */
namespace App\Services\Rpc;

use Hprose\Socket\Service;

class RpcServer
{
    public function handle(){
        $server = new Service();
        //1、rpc 服务的构建（Hpros,swoole,rabbitmq）
        $server->onSendError = function($error, \stdClass $context) {
            \Log::info($error);
        };
        //2、响应客户端请求（解析参数）

        //3、按照约定的命名规则去定位代码位置

        return $server;
    }

}