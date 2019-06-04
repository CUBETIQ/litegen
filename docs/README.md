# Lite Generator Package

## Cautious
- We Recommend u to use this with a brand new project , or it will make a mess to ur exist project
- We Recommend u to use this with a brand new project , or it will make a mess to ur exist project
- We Recommend u to use this with a brand new project , or it will make a mess to ur exist project
## Installation

On your project 
-----------
> composer.json

``` json
"autoload": {
        ...
        "psr-4": {
            ...
            "Cubetiq\\Litegen\\": "full/path/to/your/clone/package/cubetiq/litegen/src"
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

On Generated project
--------

> config/app.php
```php
'providers' => [
        ...
        /*
         * Repository Interface
         */
        \App\Providers\RepositoryInterfaceProvider::class
    ],
```