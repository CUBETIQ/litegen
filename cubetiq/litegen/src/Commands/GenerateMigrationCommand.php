<?php

namespace Cubetiq\Litegen\Commands;

use Cubetiq\Litegen\Base\traits\SubProjectContoller;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\MigrationGeneratorInterface;
use Illuminate\Console\Command;

class GenerateMigrationCommand extends Command
{
    use SubProjectContoller;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'litegen:migration 
    {--N|name= : Project Name (Default Current Project)}
    {--P|path= : Project Path (Default Current Path)}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Migration';

    /**
     * @var MigrationGeneratorInterface
     */
    private $migration;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MigrationGeneratorInterface $mig)
    {
        $this->migration=$mig;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Configuration::setProjectname($this->option('name'));
        Configuration::set_store_path($this->option('path'));

        // If u use SampleFormatter , it no use here
        Configuration::setConfigData(config('sample_model_migration'));

        if (!$this->isProjectExist()) {
            throw new \Exception("Project is not exist");
        }

        $this->migration->parse();        //
    }
}
