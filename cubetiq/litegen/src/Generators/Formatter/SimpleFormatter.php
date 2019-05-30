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
    public  function format_for_migration($data)
    {
        return $data;
    }

    /**
     * @inheritDoc
     */
    public  function format_for_model($data)
    {
        $tables=$data['columns'];
        $tables=array_map(function ($table){
            $table=array_map(function ($column){
                $column['type']=ModelType::DEFAULT;
                return $column;
            },$table);
            return $table;
        },$tables);

        foreach ($data['relationships'] as $relation){
            $ftable=$relation['from'];
            $ttable=$relation['to'];

            if($relation['type']===RelationshipType::ONE_TO_ONE){
                $from=[
                    "type"=>ModelType::BELONGS_TO,
                    "column"=>$ftable['column']
                ];
                $to=[
                    "type"=>ModelType::HAS_ONE,
                    "column"=>$ttable['column']
                ];
            }

            elseif($relation['type']===RelationshipType::ONE_TO_MANY){
                $from=[
                    "type"=>ModelType::HAS_MANY,
                    "column"=>$ttable['column']
                ];
                $to=[
                    "type"=>ModelType::BELONGS_TO,
                    "column"=>$ttable['column']
                ];
            }
            elseif ($relation['type']===RelationshipType::MANY_TO_MANY){
                // Not Implement
                continue;
            }
            else{
                continue;
            }

            $from['table']=$ttable['table'];
            $to['table']=$ftable['table'];


            $tables[$relation['from']['table']][Str::snake($relation['from']['column'])]=$from;
            $tables[$relation['to']['table']][Str::snake($relation['to']['column'])]=$to;
        }
        return $tables;
    }
}
