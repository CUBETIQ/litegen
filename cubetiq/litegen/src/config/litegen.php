<?php

return [
    "project_store_path"=>env("LITEGEN_PROJECT_STORE_PATH"),
//
    "project_name"=>env("LITEGEN_PROJECT_NAME"),

    "renderer"=>[
        "migration"=>\Cubetiq\Litegen\Generators\Migrations\NextMigrationGenerator::class,
        "model"=>\Cubetiq\Litegen\Generators\Models\NextModelGenerator::class,
        "controller"=>\Cubetiq\Litegen\Generators\Controller\SimpleControllerGenerator::class,
        "route"=>\Cubetiq\Litegen\Generators\Route\SimpleRouteGenerator::class,
        "view"=>\Cubetiq\Litegen\Generators\View\SimpleViewGenerator::class,
    ],

    "formatter"=>\Cubetiq\Litegen\Generators\Formatter\SampleFormatter::class,

];
