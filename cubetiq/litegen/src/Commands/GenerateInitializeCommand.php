<?php


namespace Cubetiq\Litegen\Commands;


use Cubetiq\Litegen\Base\BaseCommand;
use Cubetiq\Litegen\Base\traits\StubGeneratorTrait;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\MigrationGeneratorInterface;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class GenerateInitializeCommand extends BaseCommand
{
    use StubGeneratorTrait;
    protected $name="litegen:init";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'litegen:init 
    {--N|name= : Project name} 
    {--P|path= : Project Store path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use for init the project';

    /**
     * @var Filesystem
     */
    private $files;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $fs)
    {
        $this->files=$fs;
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
        Configuration::set_store_path($this->option('path') );

        $project_name = Configuration::getProjectname();
        $project_store_path=Configuration::get_store_path();
        $project_path=Configuration::get_project_path();

        // Check Project Store  Path Exist
        if(!file_exists($project_store_path)){
            $this->makeDirectory($project_store_path);
        }

        // Check If Project is Exist
        if(!$this->files->exists($project_path)){
            $this->info("Project not exist ! creating  ...");
            $process=$this->processCommand("cd ".$project_store_path." && composer create-project --no-install --no-scripts --prefer-dist laravel/laravel $project_name");

        }

        // command vendor publish , composer ...

        //

        $this->files->put($project_path."/.env",view('litegen::env')->render());

        $this->files->put($project_path."/config/app.php",$this->files->get());


        $this->info("finish Initialize");

        return 0;
    }


}
