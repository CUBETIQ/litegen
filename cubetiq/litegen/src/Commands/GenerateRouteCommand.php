<?php


namespace Cubetiq\Litegen\Commands;


use Cubetiq\Litegen\Base\traits\SubProjectContoller;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\RouteGeneratorInterface;
use Cubetiq\Litegen\Generators\ViewGeneratorInterface;
use Illuminate\Console\Command;

class GenerateRouteCommand extends Command
{
    use SubProjectContoller;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'litegen:route 
    {--N|name= : Project Name (Default Current Project)}
    {--P|path= : Project Path (Default Current Path)}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Route';

    /**
     * @var RouteGeneratorInterface
     */
    private $route;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(RouteGeneratorInterface $v)
    {
        $this->route=$v;
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

        $this->route->parse();        //
    }
}
