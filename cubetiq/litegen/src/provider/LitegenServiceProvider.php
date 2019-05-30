<?php

namespace Cubetiq\Litegen\provider;

use Cubetiq\Litegen\Commands\GenerateMigrationCommand;
use Cubetiq\Litegen\Commands\GenerateInitializeCommand;
use Cubetiq\Litegen\Commands\GenerateModelCommand;
use Cubetiq\Litegen\Generators\Formatter\SimpleFormatter;
use Cubetiq\Litegen\Generators\FormatterInterface;
use Cubetiq\Litegen\Generators\MigrationGeneratorInterface;
use Cubetiq\Litegen\Generators\Migrations\SimpleMigrationGenerator;
use Cubetiq\Litegen\Generators\ModelGeneratorInterface;
use Cubetiq\Litegen\Generators\Models\SimpleModelGenerator;
use Illuminate\Support\ServiceProvider;

class LitegenServiceProvider extends ServiceProvider
{
    private $commands=[
      GenerateMigrationCommand::class,
        GenerateInitializeCommand::class,
        GenerateModelCommand::class
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(MigrationGeneratorInterface::class,config('litegen.renderer.migration',SimpleMigrationGenerator::class));
        $this->app->bind(ModelGeneratorInterface::class,config('litegen.renderer.model',SimpleModelGenerator::class));


        $this->app->bind(FormatterInterface::class,config('litegen.formatter',SimpleFormatter::class));

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

//        dd( __DIR__."/../config/litegen.php");
        //
        $this->loadViewsFrom($this->packagedir('views'),"litegen");

        $this->commands($this->commands);

        $this->publishes([
            $this->packagedir('config/litegen.php') => base_path('config/litegen.php'),
        ]);


    }

    private function packagedir($path){
        return __DIR__."/../".$path;
    }
}
