<?php

namespace App\Providers;

use App\Services\Rpc\RpcClientService;
use App\Services\Rpc\RpcServerService;
use Illuminate\Support\ServiceProvider;

class RpcServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //注册服务端
        $this->app->singleton('rpcServer', function ($app) {
            return new RpcServerService();
        });
        //注册客户端
        $this->app->bind('rpcClient',function(){
            return new RpcClientService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //监听程序
    }
}
