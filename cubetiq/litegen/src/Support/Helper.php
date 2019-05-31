<?php


namespace Cubetiq\Litegen\Support;


class Helper
{
    public static function get_migration_config($key){
        return config('litegen.migration.'.$key);
    }

}
