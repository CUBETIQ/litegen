<?php


namespace Cubetiq\Litegen\Generators\Models;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Definitions\ModelType;
use Cubetiq\Litegen\Generators\FormatterInterface;
use Cubetiq\Litegen\Generators\ModelGeneratorInterface;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SimpleModelGenerator extends BaseGeneratorRepository implements ModelGeneratorInterface
{
    private $table_name = null;
    private $table_config = null;

    public function __construct(Filesystem $fs)
    {
        parent::__construct($fs);
    }

    public function parse()
    {
        $configs = Configuration::get_model_configData();
        foreach ($configs as $table => $config) {
            $this->table_name = $table;
            $this->table_config = $config;
            $this->generate();
        }
    }

    protected function getTargetPath()
    {
        $project_path = Configuration::get_project_path();
        $target = $project_path . "/app/Models/" . Str::studly($this->table_name) . ".php";
        return $target;
    }

    protected function getContent()
    {
        $columns = [];
        $relationships = [];

        $temp = collect($this->table_config);
        $temp->map(function ($column, $key) use(&$columns,&$relationships){
            if ($this->isColumn($column['type'])) {
                $columns[$key] = $column;
            }
            if ($this->isRelationship($column['type'])) {
                $relationships[$key] = $column;
            }
        });

        return "<?php" . PHP_EOL . view('litegen::generator.models.model_template', [
                "class" => $this->table_name,
                "columns" => $columns,
                "relationships" => $relationships
            ]);
    }

    private function isColumn($type)
    {
        return $type == ModelType::DEFAULT
            || $type == ModelType::BELONGS_TO;
    }

    private function isRelationship($type)
    {
        return $type != ModelType::DEFAULT;
    }
}
