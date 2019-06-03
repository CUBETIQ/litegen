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

    protected function getTargetPath()
    {
        $name = $this->table_name;
        return Configuration::get_project_path() . '/app/Http/Resources/' . $name . '/' . $name . 'Resource.php';
    }

    protected function getContent()
    {
        $columns = array_keys($this->resource);
        return "<?php" . PHP_EOL . view('litegen::generator.resources.item', [
                "class" => $this->table_name,
                "resource" => $this->resource,
                "columns" => $columns
            ]);
    }

    public function parse()
    {
        $resource = Configuration::get_resource_configData();

        $table_names = array_keys($resource);
        foreach ($table_names as $name) {
            $this->table_name = Helper::studly_singular($name);
            $this->resource = $resource[$name];
            $this->generate();
        }

    }

    private function get_resourceConfig()
    {
        $name = $this->table_name;
        $output = Configuration::get_project_path() . '/app/Http/Resources/' . $name . '/' . $name . 'Resource.php';
        $content = view()->render();
        return [
            "output" => $output,
            "content" => $content
        ];
    }
}
