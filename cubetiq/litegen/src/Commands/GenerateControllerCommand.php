<?php


namespace Cubetiq\Litegen\Commands;


use Cubetiq\Litegen\Base\traits\SubProjectContoller;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\ControllerGeneratorInterface;
use Cubetiq\Litegen\Generators\ModelGeneratorInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateControllerCommand extends Command
{
    use SubProjectContoller;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'litegen:controller 
    {--N|name= : Project Name (Default Current Project)}
    {--P|path= : Project Path (Default Current Path)}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Controller';

    /**
     * @var ModelGeneratorInterface
     */
    private $controller;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ControllerGeneratorInterface $ctr)
    {
        $this->controller=$ctr;
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
        Configuration::setConfigData(config('sample_controller'));

        if (!$this->isProjectExist()) {
            throw new \Exception("Project is not exist");
        }

        // Route
        Artisan::call('litegen:route');
        // View
        Artisan::call('litegen:view');

        $this->controller->parse();        //
    }
}
