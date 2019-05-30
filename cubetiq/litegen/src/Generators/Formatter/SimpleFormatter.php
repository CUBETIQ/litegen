<?php


namespace Cubetiq\Litegen\Generators\Formatter;


use Cubetiq\Litegen\Definitions\RelationshipType;
use Cubetiq\Litegen\Generators\FormatterInterface;

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
        $tables=[];
        foreach ($data['relationships'] as $relation){
            if($relation['type']===RelationshipType::ONE_TO_ONE){
//                $table[$relation['from']]
            }
        }
    }
}
