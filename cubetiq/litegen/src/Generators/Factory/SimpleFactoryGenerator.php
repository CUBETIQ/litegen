<?php


namespace Cubetiq\Litegen\Generators\Factory;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\FactoryGeneratorInterface;
use Illuminate\Support\Str;

class SimpleFactoryGenerator extends BaseGeneratorRepository implements FactoryGeneratorInterface
{
    private $table_name;
    private $table_columns;

    public function parse()
    {
        $models=Configuration::get_factory_configData();
        foreach ($models['data'] as $table=>$columns){
            $this->table_name=Str::studly(Str::singular($table));
            $this->table_columns=$columns;
            $this->generate();
        }
    }

    protected function getTargetPath()
    {
        $name=$this->table_name."Factory.php";
        return Configuration::get_project_path()."/database/factories/".$name;
    }

    protected function getContent()
    {
        $content="<?php".PHP_EOL.view('litegen::generator.factory.simple.factory',[
            "columns"=>$this->table_columns,
                "class"=>$this->table_name
        ])->render();
        return $content;
    }
}
