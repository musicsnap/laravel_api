<?php

namespace App\Providers;

use App\Services\Rpc\RpcServer;
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
        //定义绑定关系
        $this->app->singleton('rpc.server', function ($app) {
            return new RpcServer();
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
        $routeFilePath = base_path('routes/rpc.php');
        if (!file_exists($routeFilePath)) {
            throw new \Exception('缺少rpc路由文件', 500);
        }
        require $routeFilePath;
    }
}
