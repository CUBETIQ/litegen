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
    protected $signature = 'litegen:migration {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $project_name = $this->argument("name");

        Configuration::setProjectname($project_name);
        Configuration::setConfigs(config('sample.tables'));

        if (!$this->isProjectExist()) {
            throw new \Exception("Project is not exist");
        }

        $configs=Configuration::getConfigs();

        $tables=array_keys($configs['columns']);

        $this->migration->parse();        //
    }
}
