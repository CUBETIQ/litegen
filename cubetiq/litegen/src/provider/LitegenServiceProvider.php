<?php

namespace Cubetiq\Litegen\provider;

use Cubetiq\Litegen\Commands\DatabaseToConfigCommand;
use Cubetiq\Litegen\Commands\GenerateControllerCommand;
use Cubetiq\Litegen\Commands\GenerateMigrationCommand;
use Cubetiq\Litegen\Commands\GenerateInitializeCommand;
use Cubetiq\Litegen\Commands\GenerateModelCommand;
use Cubetiq\Litegen\Commands\GenerateOwnTemplateCommand;
use Cubetiq\Litegen\Commands\GenerateResourceCommand;
use Cubetiq\Litegen\Commands\GenerateRouteCommand;
use Cubetiq\Litegen\Commands\GenerateViewCommand;
use Cubetiq\Litegen\Generators\Controller\SimpleControllerGenerator;
use Cubetiq\Litegen\Generators\ControllerGeneratorInterface;
use Cubetiq\Litegen\Generators\Formatter\SimpleFormatter;
use Cubetiq\Litegen\Generators\FormatterInterface;
use Cubetiq\Litegen\Generators\MigrationGeneratorInterface;
use Cubetiq\Litegen\Generators\Migrations\NextMigrationGenerator;
use Cubetiq\Litegen\Generators\Migrations\SimpleMigrationGenerator;
use Cubetiq\Litegen\Generators\ModelGeneratorInterface;
use Cubetiq\Litegen\Generators\Models\NextModelGenerator;
use Cubetiq\Litegen\Generators\Models\SimpleModelGenerator;
use Cubetiq\Litegen\Generators\Resource\SimpleResourceGenerator;
use Cubetiq\Litegen\Generators\ResourceGeneratorInterface;
use Cubetiq\Litegen\Generators\Route\SimpleRouteGenerator;
use Cubetiq\Litegen\Generators\RouteGeneratorInterface;
use Cubetiq\Litegen\Generators\View\SimpleViewGenerator;
use Cubetiq\Litegen\Generators\ViewGeneratorInterface;
use Illuminate\Support\ServiceProvider;

class LitegenServiceProvider extends ServiceProvider
{
    private $commands = [
        GenerateMigrationCommand::class,
        GenerateInitializeCommand::class,
        GenerateModelCommand::class,
        GenerateControllerCommand::class,
        GenerateViewCommand::class,
        GenerateRouteCommand::class,
        GenerateResourceCommand::class,
        GenerateOwnTemplateCommand::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MigrationGeneratorInterface::class, config('litegen.renderer.migration', NextMigrationGenerator::class));
        $this->app->bind(ModelGeneratorInterface::class, config('litegen.renderer.model', NextModelGenerator::class));
        $this->app->bind(ControllerGeneratorInterface::class, config('litegen.renderer.controller', SimpleControllerGenerator::class));
        $this->app->bind(ViewGeneratorInterface::class, config('litegen.renderer.view', SimpleViewGenerator::class));
        $this->app->bind(RouteGeneratorInterface::class, config('litegen.renderer.route', SimpleRouteGenerator::class));
        $this->app->bind(ResourceGeneratorInterface::class, config('litegen.renderer.resource', SimpleResourceGenerator::class));


        $this->app->bind(FormatterInterface::class, config('litegen.formatter', SimpleFormatter::class));

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
        $this->loadViewsFrom($this->packagedir('Templates'), "litegen");
        $this->loadViewsFrom(base_path('resources/template'), "template");

        $this->commands($this->commands);

        $this->publishes([
            $this->packagedir('config/litegen.php') => base_path('config/litegen.php'),
            $this->packagedir('sample/sample.php') => base_path('config/sample.php'),
        ]);


    }

    private function packagedir($path)
    {
        return __DIR__ . "/../" . $path;
    }
}
