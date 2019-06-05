<?php


namespace Cubetiq\Litegen\Generators\Formatter;


use Cubetiq\Litegen\Definitions\MigrationType;
use Cubetiq\Litegen\Definitions\ModelType;
use Cubetiq\Litegen\Definitions\RelationshipType;
use Cubetiq\Litegen\Generators\FormatterInterface;

class NextFormatter extends SampleFormatter implements FormatterInterface
{
    public function format_for_controller($data)
    {
        $result=[];
        foreach ($data['tables'] as $table=>$configs){
            $result[$table]=$configs['actions'];
        }
        return [
            "actions"=>$result,
            "non-actions"=>$data['non-tables']
        ];
    }

    public function format_for_model($data)
    {
        $result=[];
        foreach ($data['tables'] as $table=>$configs){
            $result[$table]=array_map(function ($column){
                $column['unique']=$column['unique'] ?? false;
                $column['nullable']=$column['nullable'] ?? false;
                return $column;
            },$configs['columns']);

            $meta[$table]=[
                "timestamps"=>$configs['meta']['timestamps'] ?? false
            ];
        }
        return [
            "data"=>$result,
            "meta"=>$meta
        ];
    }
}
