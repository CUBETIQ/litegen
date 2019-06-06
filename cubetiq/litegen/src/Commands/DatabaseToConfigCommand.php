<?php


namespace Cubetiq\Litegen\Commands;


use Cubetiq\Litegen\Base\BaseCommand;
use Cubetiq\Litegen\Base\traits\StubGeneratorTrait;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Definitions\ModelType;
use Cubetiq\Litegen\Generators\MigrationGeneratorInterface;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class DatabaseToConfigCommand extends BaseCommand
{
    use StubGeneratorTrait;
    protected $name="litegen:db2config";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'litegen:db2config 
    {--H|host= : Database Server host} 
    {--D|db=   : Database Name} 
    {--U|user= : Database Username} 
    {--P|pass= : Database Password} 
    {--I|port= : Database Port}';

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
        dd($this->options());
    }


}
