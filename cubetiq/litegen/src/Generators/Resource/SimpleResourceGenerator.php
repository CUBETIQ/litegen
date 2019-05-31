<?php


namespace Cubetiq\Litegen\Generators\Resource;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\ResourceGeneratorInterface;

class SimpleResourceGenerator extends BaseGeneratorRepository implements ResourceGeneratorInterface
{
    private $table_name;

    protected function getTargetPath()
    {
//        $output=Str
//        return
    }

    protected function getContent()
    {

    }

    public function parse()
    {
        $controllers=Configuration::get_resource_configData();
        $table_names=array_keys($controllers['actions']);
        foreach ($table_names as $name)
        {

        }
        dd($table_names);
    }
}
