<?php


namespace Cubetiq\Litegen\Generators\Models;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Definitions\ModelType;
use Cubetiq\Litegen\Generators\ModelGeneratorInterface;
use Illuminate\Support\Str;

class NextModelGenerator extends BaseGeneratorRepository implements ModelGeneratorInterface
{
    private $table_name;
    private $table_columns;

    const RelationshipType=[
        ModelType::BELONGS_TO,
        ModelType::HAS_MANY,
        ModelType::HAS_ONE,
        ModelType::BELONGSTOMANY,
    ];

    public function parse()
    {
        $data=Configuration::get_model_configData();
        foreach ($data as $table=>$columns){
            $this->table_name=Str::singular(Str::studly($table));
            $this->table_columns=$columns;
            $this->generate();
        }
    }

    protected function getTargetPath()
    {
        $name=$this->table_name;
        return Configuration::get_project_path()."/app/Models/$name.php";
    }

    protected function getContent()
    {
        // Fillable Column
        $fillable=$this->get_fillable_columns();

        // Relationship Columns
        $relationships=$this->get_relationships();

        return "<?php".PHP_EOL.view('litegen::generator.models.next.model_template',[
            "name"=>$this->table_name,
            "columns"=>$this->table_columns,
                "fillable"=>$fillable,
                "relationships"=>$relationships
        ])->render();
    }

    private function get_fillable_type(){
        $unfillable=[
            ModelType::BELONGSTOMANY,
            ModelType::HAS_ONE,
            ModelType::HAS_MANY
        ];
        $cons=new \ReflectionClass(ModelType::class);
        return array_diff($cons->getConstants(),$unfillable);
    }

    private function get_fillable_columns(){
        $fillableType=$this->get_fillable_type();
        $fillable=[];
        foreach ($this->table_columns as $column=>$config){
            if(!in_array($config['type'],$fillableType)){
                continue;
            }
            if($config['type']===ModelType::BELONGS_TO){
                array_push($fillable,$config['foreign']);
                continue;
            }
            array_push($fillable,$column);
        }
        return $fillable;
    }

    private function get_relationships(){
        $relates=[];
        foreach ($this->table_columns as $column=>$config){
            if(!in_array($config['type'],self::RelationshipType)){
                continue;
            }

            $relates[$column]=$config;
        }
        return $relates;
    }
}
