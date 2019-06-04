<?php


namespace Cubetiq\Litegen\Support;


use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Definitions\ModelType;
use Cubetiq\Litegen\Definitions\RelationshipType;
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

    public static function get_fillable_columns($table){
        $cons=new \ReflectionClass(ModelType::class);
        $types=$cons->getConstants();
        $model=Configuration::get_model_configData()['data'];

        $types["belongto"]=RelationshipType::BELONGS_TO;

        $fillable = [];
        foreach ($model[$table] as $column => $config) {
            if (!in_array($config['type'], $types)) {
                continue;
            }
            if ($config['type'] === RelationshipType::BELONGS_TO) {
                array_push($fillable, $config['foreign']);
                continue;
            }
            array_push($fillable, $column);
        }
        return $fillable;
    }
}
