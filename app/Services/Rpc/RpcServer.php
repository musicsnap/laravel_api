<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\5\8 0008
 * Time: 23:07
 */
namespace App\Services\Rpc;

use Hprose\Http\Server;

class RpcServer extends Server
{
    public function __construct()
    {
        parent::__construct();

    }
}
