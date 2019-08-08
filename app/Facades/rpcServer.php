<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class rpcServer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'rpcServer';
    }
}
