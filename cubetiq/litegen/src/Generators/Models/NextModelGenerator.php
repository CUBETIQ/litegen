<?php


namespace Cubetiq\Litegen\Generators\Models;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Definitions\ModelType;
use Cubetiq\Litegen\Definitions\RelationshipType;
use Cubetiq\Litegen\Generators\ModelGeneratorInterface;
use Illuminate\Support\Str;

class NextModelGenerator extends BaseGeneratorRepository implements ModelGeneratorInterface
{
    private $table_name;
    private $table_columns;
    private $origin_name;

//    const RelationshipType=[
//        ModelType::BELONGS_TO,
//        ModelType::HAS_MANY,
//        ModelType::HAS_ONE,
//        ModelType::BELONGSTOMANY,
//    ];

    public function parse()
    {
        $configs = Configuration::get_model_configData();
        foreach ($configs['data'] as $table => $columns) {
            $this->table_name = Str::singular(Str::studly($table));
            $this->origin_name=$table;
            $this->table_columns = $columns;
            $this->generate();
        }
    }

    protected function getTargetPath()
    {
        $name = $this->table_name;
        return Configuration::get_project_path() . "/app/Models/$name.php";
    }

    protected function getContent()
    {
        // Fillable Column
        $fillable = $this->get_fillable_columns();

        // Relationship Columns
        $relationships = $this->get_relationships();

        return "<?php" . PHP_EOL . view('litegen::generator.models.next.model_template', [
                "name" => $this->table_name,
                "columns" => $this->table_columns,
                "fillable" => $fillable,
                "relationships" => $relationships
            ])->render();
    }

    private function get_fillable_type()
    {

        $cons = new \ReflectionClass(ModelType::class);
        $fillable = $cons->getConstants();
        $fillable['belongto'] = RelationshipType::BELONGS_TO;
        return $fillable;
    }

    private function get_fillable_columns()
    {
        $fillableType = $this->get_fillable_type();
        $fillable = [];
        foreach ($this->table_columns as $column => $config) {
            if (!in_array($config['type'], $fillableType)) {
                continue;
            }
            if ($config['type'] === RelationshipType::BELONGS_TO) {
                array_push($fillable, $config['foreign']);
                continue;
            }
            array_push($fillable, $column);
        }
        return $fillable;
    }

    private function get_relationships()
    {
        $relates = [];
        $cons = new \ReflectionClass(RelationshipType::class);
        $types = $cons->getConstants();
        foreach ($this->table_columns as $column => $config) {
            if (!in_array($config['type'], $types)) {
                continue;
            }

            $relates[$column] = $config;
        }
        return $relates;
    }
}
