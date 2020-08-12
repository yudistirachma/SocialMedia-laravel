<?php

namespace App\Console\Commands;

use App\Category;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class RefreshDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command for refresh database by adding some default data';

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
        $this->call('migrate:refresh'); 
        $this->call('db:seed');
        
        $this->info('this command has been refreshed add seeded');
    }
}
