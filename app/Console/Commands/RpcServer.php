<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Facades\rpcServer as Rpc;

class RpcServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rpc:server';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'rpc:server';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Rpc::runServer();
        //
        $server = app('rpcServer');//这个不知道为啥不行
//        var_dump($server);
//        $server->start();
    }
}
