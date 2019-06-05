<?php


namespace Cubetiq\Litegen;


use Cubetiq\Litegen\Generators\Formatter\SimpleFormatter;
use Cubetiq\Litegen\Generators\FormatterInterface;

class Configuration
{
    private static $project_name = null;
    private static $project_store_path = null;
    private static $config_data;
    /**
     * @var FormatterInterface
     */
    private static $formatter;

    /**
     * @return FormatterInterface
     */
    private static function getFormatter(){
        if(self::$formatter)
            return self::$formatter;
        self::$formatter=app(config('litegen.formatter',SimpleFormatter::class));
        return self::getFormatter();
    }

    public static function getAssetPath($name=null){
        $reflector = new \ReflectionClass(Configuration::class);
        $filepath=explode(DIRECTORY_SEPARATOR,$reflector->getFileName());
        array_pop($filepath);
        array_push($filepath,"Assets");
        return implode(DIRECTORY_SEPARATOR,$filepath).DIRECTORY_SEPARATOR.$name;
    }

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

    public static function getConfigData()
    {
        return config('sample');
        if (!self::$config_data) {
            throw new \Exception("Config is null");
        }
        return self::$config_data;
    }

    public static function setConfigData($configs)
    {
        self::$config_data = $configs;
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

    public static function get_controllers_data(){
        return self::getFormatter()->format_for_controller(self::getConfigData());
    }

    public static function get_model_configData(){
        return self::getFormatter()->format_for_model(self::getConfigData());
    }

    public static function get_migration_configData(){
        return self::getFormatter()->format_for_migration(self::getConfigData());
    }

    public static function get_view_configData(){
        return self::getFormatter()->format_for_view(self::getConfigData());
    }

    public static function get_route_configData(){
        return self::getFormatter()->format_for_route(self::getConfigData());
    }

    public static function get_resource_configData(){
        return self::getFormatter()->format_for_resource(self::getConfigData());
    }
}
