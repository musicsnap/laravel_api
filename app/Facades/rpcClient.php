<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class rpcClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'rpcClient';
    }
}
