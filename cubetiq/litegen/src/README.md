# Lite Generator Package
Make your new project with pre config data

## Cautious
- We Recommend u to use this with a brand new project , or it will make a mess to ur exist project
- We Recommend u to use this with a brand new project , or it will make a mess to ur exist project
- We Recommend u to use this with a brand new project , or it will make a mess to ur exist project

----

## On this page

- TOC

----
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

> Edit config/sample.php

----
## Usage

> Initialize project

``` sh
$ php artisan litegen:init [--name=projectname] [--path=project path]
```



> create model

``` sh
$ php artisan litegen:model [--name=projectname] [--path=project path]
```

> create migration

``` sh
$ php artisan litegen:migration [--name=projectname] [--path=project path] [--seeder : make seeder and factory]
```


> create controller

``` sh
$ php artisan litegen:controller [--name=projectname] [--path=project path] [-R : with route] [-I : with view] 
```
> Make Your own Default Generate View Template

``` sh
$ php artisan litegen:myview [--name=projectname] [--path=project path]
```
----
**Warning** :
you should `composer dumpauto` everytime you generate new class 

----
## Generated Project


> config/app.php

``` php
'providers' => [
        ...
        /*
         * Interface bind Repository Service Provider
         */
        \App\Providers\RepositoryInterfaceProvider::class
    ],
```


> install composer

``` sh
$ composer install
```

> run server
``` sh
$ php artisan serve
```

----
## Processing
<img src="./docs/litegen.png"
     alt="Lite Generator"
     style="float: left; margin-right: 10px;" />


