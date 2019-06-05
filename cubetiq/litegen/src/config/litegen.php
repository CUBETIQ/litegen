<?php

return [
    "project_store_path" => env("LITEGEN_PROJECT_STORE_PATH"),
//
    "project_name" => env("LITEGEN_PROJECT_NAME"),

    /**
     *  Main renderer use to Generate file
     */
    "renderer" => [
        "migration" => \Cubetiq\Litegen\Generators\Migrations\NextMigrationGenerator::class,
        "model" => \Cubetiq\Litegen\Generators\Models\NextModelGenerator::class,
        "controller" => \Cubetiq\Litegen\Generators\Controller\SimpleControllerGenerator::class,
        "route" => \Cubetiq\Litegen\Generators\Route\SimpleRouteGenerator::class,
        "view" => \Cubetiq\Litegen\Generators\View\SimpleViewGenerator::class,
    ],

    /*
     * Formatter use to make data fit with format in renderer
     * must implement Cubetiq\Litegen\Generators\FormatterInterface
     */
    "formatter" => \Cubetiq\Litegen\Generators\Formatter\NextFormatter::class,


    /*
     * to use here
     * run :
     *       php artisan litegen:myview
     * then uncomment below
     * Template for renderer use for render template
     * Use in SimpleViewGenerator
     */
    "views" => [
//        "index"=>"template::index",
//        "create" => "template::create",
//        "update" => "template::update",
//        "show" => "template::show"
    ]
];
