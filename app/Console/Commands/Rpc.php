<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Rpc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rpc:server {argc}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'rpc server';

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
        //
        $argc = $this->argument('argc');

        $server = app('rpc.server');
//        var_dump($server);
//        $server->start();
    }
}
