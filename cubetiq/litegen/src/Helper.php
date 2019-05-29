<?php


namespace Cubetiq\Litegen;


class Helper
{
    public static function get_migration_config($key){
        return config('litegen.migration.'.$key);
    }
}
