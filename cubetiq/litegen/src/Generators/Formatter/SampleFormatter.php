<?php


namespace Cubetiq\Litegen\Generators\Formatter;


use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\FormatterInterface;

class SampleFormatter implements FormatterInterface
{
    public function format_for_model($data)
    {
        return config('sample_model_migration');
    }

    public function format_for_controller($data)
    {
        return config('sample_controller');
    }

    public function format_for_migration($data)
    {
        return config('sample_model_migration');
    }
    public function format_for_resource($data)
    {
        $models=Configuration::get_model_configData();
        $tables=$models['tables'];
        return $tables;
    }

    public function format_for_route($data)
    {
        return config('sample_controller');
    }

    public function format_for_view($data)
    {
        return config('sample_controller');
    }

}
