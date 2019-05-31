<?php


namespace Cubetiq\Litegen\Generators\Formatter;


use Cubetiq\Litegen\Definitions\ModelType;
use Cubetiq\Litegen\Definitions\RelationshipType;
use Cubetiq\Litegen\Generators\FormatterInterface;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Str;

class SimpleFormatter implements FormatterInterface
{

    /**
     * @inheritDoc
     */
    public function format_for_migration($data)
    {
        return $data;
    }

    /**
     * @inheritDoc
     */
    public function format_for_model($data)
    {
        return $data;
    }
    /**
     * @inheritDoc
     */
    public function format_for_controller($data)
    {
        return $data;

    }


    /**
     * @inheritDoc
     */
    public function format_for_view($data)
    {
        return $data;
    }

    /**
     * @inheritDoc
     */
    public function format_for_route($data)
    {
        return $data;
    }


    /**
     * @inheritDoc
     */
    public function format_for_resource($data)
    {
        return $data;
    }
}
