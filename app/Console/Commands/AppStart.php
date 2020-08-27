<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrating and seeding';

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
     * @return int
     */
    public function handle()
    {
        $this->call('migrate');
        $this->call('db:seed');
    }
}
