<?php


namespace Cubetiq\Litegen;


class Configuration
{
    private static $project_name = null;
    private static $project_store_path = null;
    private static $tables_config;

    public static function getProjectname()
    {
        if (self::$project_name) {
            return self::$project_name;
        }
        $current_project_name = array_reverse(explode(DIRECTORY_SEPARATOR, base_path('')))[0];
        return config('litegen.project_name') ?? $current_project_name;
    }

    public static function setProjectname($name)
    {
        if ($name)
            self::$project_name = $name;
    }

    public static function getConfigs()
    {
        if (!self::$tables_config) {
            throw new \Exception("Config is null");
        }
        return self::$tables_config;
    }

    public static function setConfigs($configs)
    {
        self::$tables_config = $configs;
    }

    public static function get_store_path()
    {
        if (self::$project_store_path) {
            return self::$project_store_path;
        }
        $path=explode(DIRECTORY_SEPARATOR,base_path());
        array_pop($path);
        $current_project_storepath = implode(DIRECTORY_SEPARATOR,$path);
        return config('litegen.project_store_path') ?? $current_project_storepath;
    }


    public static function set_store_path($path)
    {
        if ($path)
            self::$project_store_path = $path;
    }

    public static  function get_project_path(){
        return self::get_store_path().DIRECTORY_SEPARATOR.self::getProjectname();
    }
}
