<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MovStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mov:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fresh setup';

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
        $this->call('key:generate');
        $this->call('route:clear');
        $this->call('migrate:fresh');
        $this->call('passport:client', ['--personal' => true, '--name' => config('app.name').' Personal Access Client']);
        $this->call('passport:client', ['--password' => true, '--name' => config('app.name').' Password Grant Client']);
        $this->call('db:seed');
    }
}
