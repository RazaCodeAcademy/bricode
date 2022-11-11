<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class generateDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:db {db_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate db by command';

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
        $db_name = $this->argument('db_name') ? $this->argument('db_name') : 'concard';
        DB::connection('mysql')->statement("CREATE DATABASE $db_name");
        $this->info('DB generated successfuly!');
    }
}