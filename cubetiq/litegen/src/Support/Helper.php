<?php


namespace Cubetiq\Litegen\Support;


use Illuminate\Support\Str;

class Helper
{
    public static function get_migration_config($key){
        return config('litegen.migration.'.$key);
    }

    public static function studly_singular($text){
        return Str::singular(Str::studly($text));
    }

    public static function db_tname_format($name){
        return Str::snake(Str::plural($name));
    }
}
