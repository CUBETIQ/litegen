# Lite Generator Package

## Cautious
- We Recommend u to use this with a brand new project , or it will make a mess to ur exist project
- We Recommend u to use this with a brand new project , or it will make a mess to ur exist project
- We Recommend u to use this with a brand new project , or it will make a mess to ur exist project
## Installation Main Project



> composer.json

``` json
"autoload": {
        ...
        "psr-4": {
            ...
            "Cubetiq\\Litegen\\": "[full/path/to/your/clone/package]/cubetiq/litegen/src",
            ...
        },
        ...
    },
```

``` sh
$ composer install
```

> config/app.php

``` php
'providers' => [
        ...
        /*
         * Lite Generator Provider
         */
        \Cubetiq\Litegen\provider\LitegenServiceProvider::class
    ],
```

``` sh
$ php artisan vendor:publish --provider="Cubetiq\Litegen\provider\LitegenServiceProvider"
```

## Usage

> Edit config/sample.php

> create model

``` sh
$ php artisan litegen:model [--name=projectname] [--path=project path]
```

> create migration

``` sh
$ php artisan litegen:migration [--name=projectname] [--path=project path]
```


> create controller

``` sh
$ php artisan litegen:controller [--name=projectname] [--path=project path] [-R : with route] [-I : with view] 
```

## Generated Project
> install composer

``` sh
$ composer install
```

> run 
``` sh
$ php artisan serve
```

