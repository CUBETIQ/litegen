<?php


namespace Cubetiq\Litegen\Generators\Formatter;


use Cubetiq\Litegen\Generators\FormatterInterface;

class SampleFormatter implements FormatterInterface
{
    public function format_for_controller($data)
    {
        return config('sample_controller');
        return $data;
    }

    public function format_for_model($data)
    {
        return config('sample_model.tables');
        return $data;
    }

    public function format_for_migration($data)
    {
        return config('sample_migration.tables');
        return $data;
    }
}
