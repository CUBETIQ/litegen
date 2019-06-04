<?php


namespace Cubetiq\Litegen\Generators\Resource;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\ResourceGeneratorInterface;
use Cubetiq\Litegen\Support\Helper;

class SimpleResourceGenerator extends BaseGeneratorRepository implements ResourceGeneratorInterface
{
    private $table_name;
    private $resource;


    public function parse()
    {
        $resource = Configuration::get_resource_configData()['data'];

        $table_names = array_keys($resource);
        foreach ($table_names as $name) {
            $this->table_name = Helper::studly_singular($name);
            $this->resource = $resource[$name];

            $temp=$this->config_for_columns();
            $output=$temp['output'];
            $content=$temp['content'];
            $this->generate($output,$content);

            $temp=$this->config_for_relationship();
            $output=$temp['output'];
            $content=$temp['content'];
            $this->generate($output,$content);
        }

    }

    private function config_for_relationship(){
        $name = $this->table_name;
        $columns = array_keys($this->resource);

        $output= Configuration::get_project_path() . '/app/Http/Resources/' . $name . '/' . $name . 'Relationship.php';
        $content= "<?php" . PHP_EOL . view('litegen::generator.resources.simple.relationships', [
                "class" => $this->table_name,
                "resource" => $this->resource,
                "columns" => $columns
            ])->render();
        return [
            "output" => $output,
            "content" => $content
        ];
    }

    private function config_for_columns()
    {
        $name = $this->table_name;
        $columns = array_keys($this->resource);

        $output= Configuration::get_project_path() . '/app/Http/Resources/' . $name . '/' . $name . 'Resource.php';
        $content= "<?php" . PHP_EOL . view('litegen::generator.resources.simple.columns', [
                "class" => $this->table_name,
                "resource" => $this->resource,
                "columns" => $columns
            ])->render();
        return [
            "output" => $output,
            "content" => $content
        ];
    }
}
