# Installation
> composer.json 
```json
"autoload": {
        ...
        "psr-4": {
            ...
            "Cubetiq\\Litegen\\": "full/path/to/your/clone/package/cubetiq/litegen/src"
        },
        ...
    },
```

```sh
$ composer install
```

> config/app.php
```php
'providers' => [
        ...
        /*
         * Lite Generator Provider
         */
        \Cubetiq\Litegen\provider\LitegenServiceProvider::class
    ],

```

```sh
$ php artisan vendor:publish --provider="Cubetiq\Litegen\provider\LitegenServiceProvider"
```
