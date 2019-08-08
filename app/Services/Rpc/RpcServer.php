<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\5\8 0008
 * Time: 23:07
 */
namespace App\Services\Rpc;

use Hprose\Socket\Server;

class RpcServer extends Server
{
    public function __construct($uri = null)
    {
        parent::__construct($uri);
        $this->uris = [];
        if ($uri) {
            $this->addListener($uri);
        }
    }
}
