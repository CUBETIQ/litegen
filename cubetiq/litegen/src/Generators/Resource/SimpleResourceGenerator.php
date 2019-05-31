<?php


namespace Cubetiq\Litegen\Generators\Resource;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\ResourceGeneratorInterface;
use Cubetiq\Litegen\Support\Helper;

class SimpleResourceGenerator extends BaseGeneratorRepository implements ResourceGeneratorInterface
{
    private $table_name;

    protected function getTargetPath()
    {
        $name='';
        return Configuration::get_project_path().'/app/Http/Resources/'.$name.'/'.$name.'Resource.php';
    }

    protected function getContent()
    {
        return view();
    }

    public function parse()
    {
        $controllers=Configuration::get_resource_configData();
        $table_names=array_keys($controllers['actions']);
        foreach ($table_names as $name)
        {
            $this->table_name=Helper::studly_singular($name);
        }
        dd($table_names);
    }

    private function get_resourceConfig(){
        $name=$this->table_name;
        $output= Configuration::get_project_path().'/app/Http/Resources/'.$name.'/'.$name.'Resource.php';
        $content=view()->render();
        return [
            "output"=>$output,
            "content"=>$content
        ];
    }
}
