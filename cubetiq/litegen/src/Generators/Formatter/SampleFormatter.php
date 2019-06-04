<?php


namespace Cubetiq\Litegen\Generators\Formatter;


use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\FormatterInterface;

class SampleFormatter implements FormatterInterface
{
    public function format_for_model($data)
    {
        $data= config('sample_model_migration');
        foreach ($data['data'] as $table=>$columns){
            foreach ($columns as $column=>$config){
                $data['data'][$table][$column]['unique']=$config['unique'] ?? false;
                $data['data'][$table][$column]['nullable']=$config['nullable'] ?? false;
            }
        }
        return $data;
    }

    public function format_for_controller($data)
    {
        return config('sample_controller');
    }

    public function format_for_migration($data)
    {
        return Configuration::get_model_configData();
    }
    public function format_for_resource($data)
    {
        $models=Configuration::get_model_configData();
        return $models;
    }

    public function format_for_route($data)
    {
        return Configuration::get_controllers_data();
    }

    public function format_for_view($data)
    {
        return Configuration::get_controllers_data();
    }

}
