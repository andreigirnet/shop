<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class EcommerceInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecommerce:install {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install dummy data for the ecommerce application';

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
        if($this->option('force')){
            $this->proceed();
        }else{
            if($this->confirm('this will delete all your current data and will install the defailt data. Are you sure?')){
                $this->proceed();
            }

        }
    }

    protected function proceed(){

            File::deleteDirectory(public_path('storage/products/dummy'));
            $this->callSilent('storage:link');
            $copySuccess = File::copyDirectory(public_path('/img/products'), public_path('storage/products/dummy'));
            if ($copySuccess){
                $this->info('Images successfully copied to storage folder');
            }
            $this->call('migrate:fresh',[
                '--seed'=>true,
            ]);
            $this->call('db:seed',[
                '--class'=>'VoyagerDatabaseSeeder',
            ]);
            $this->call('db:seed',[
                '--class'=>'VoyagerDummyDatabaseSeeder',
            ]);
            $this->call('db:seed',[
                '--class'=>'MenusTableSeederCustom',
            ]);
            $this->info('Dummy data installed');

    }

}
