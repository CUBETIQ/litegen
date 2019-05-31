<?php

return [
    "project_store_path"=>env("LITEGEN_PROJECT_STORE_PATH"),
//
    "project_name"=>env("LITEGEN_PROJECT_NAME"),

    "renderer"=>[
        "migration"=>\Cubetiq\Litegen\Generators\Migrations\SimpleMigrationGenerator::class,
        "model"=>\Cubetiq\Litegen\Generators\Models\SimpleModelGenerator::class,
        "controller"=>\Cubetiq\Litegen\Generators\Controller\SimpleControllerGenerator::class
    ],

    "formatter"=>\Cubetiq\Litegen\Generators\Formatter\NextFormatter::class,

    "migration"=>[
//        "method"=>[
//            \Cubetiq\Litegen\Definitions\MigrationType::VARCHAR=>"string",
//            \Cubetiq\Litegen\Definitions\MigrationType::DECIMAL=>"decimal",
//            \Cubetiq\Litegen\Definitions\MigrationType::DATETIME=>"datetime"
//        ],
        "default"=>[
            \Cubetiq\Litegen\Definitions\MigrationType::VARCHAR."-length"=>10,

            \Cubetiq\Litegen\Definitions\MigrationType::DECIMAL."-length"=>10,
            \Cubetiq\Litegen\Definitions\MigrationType::DECIMAL."-scale"=>2,
        ],
//        "template"=>[
//            \Cubetiq\Litegen\Definitions\MigrationType::VARCHAR=>'$table->string({name},{length}){nullable}{unique}',
//            \Cubetiq\Litegen\Definitions\MigrationType::DECIMAL=>'$table->decimal({name},{length},{scale}){nullable}',
//            \Cubetiq\Litegen\Definitions\MigrationType::DATETIME=>'$table->datetime({name}){nullable}{unique}'
//        ]
    ],

];
