<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ModulesResources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module-resources {moduleName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make dir for module in views and assests';

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
        $assets = resource_path('/assets/modules/'.$this->argument('moduleName'));
        mkdir($assets, 0777); 
		
		$views  = resource_path('/views/modules/'.$this->argument('moduleName'));
		mkdir($views, 0777);
		
		$this->line('Resources Created!!');
    }
}
