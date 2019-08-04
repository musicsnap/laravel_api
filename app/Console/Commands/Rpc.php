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
        $this->comment('版本:');
        $this->output->newLine();

        $this->comment('监听:');
        $this->line(sprintf(' - <info>%s</>', config('rpc.uri')));
        $this->output->newLine();

        $this->comment('可调用远程方法:');
        $methods = '';
        if ($methods) {
            foreach ($methods as $method) {
                $this->line(sprintf(' - <info>%s</>', $method));
            }
            $this->output->newLine();
        } else {
            $this->line(sprintf(' - <info>无可调用方法</>'));
        }
        $server = app('rpc.server');
        $server->start();
    }
}
