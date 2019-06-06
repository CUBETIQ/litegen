<?php


namespace Cubetiq\Litegen\Generators\Seeder;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\SeederGeneratorInterface;
use Illuminate\Support\Str;

class SimpleSeederGenerator extends BaseGeneratorRepository implements SeederGeneratorInterface
{
    private $table_name;
    private $table_names;

    public function parse()
    {
        $models=Configuration::get_seeder_configData();
        $this->table_names=[];
        foreach ($models['data'] as $table=>$columns){
            $this->table_name=Str::plural(Str::studly(Str::singular($table)));
            array_push($this->table_names,$this->table_name);
            $this->generate();
        }

        // Register to Database Seeder
        $temp=$this->config_for_register();
        $output=$temp['output'];
        $content=$temp['content'];
        $this->generate($output,$content);
    }

    private function config_for_register(){
        $name="DatabaseSeeder.php";
        $content="<?php".PHP_EOL.view('litegen::generator.seeders.dbseeder',[
            "names"=>$this->table_names
        ])->render();
        return [
            "output"=>Configuration::get_project_path()."/database/seeds/".$name,
            "content"=>$content
        ];
    }

    protected function getContent()
    {
        return "<?php".PHP_EOL.view('litegen::generator.seeders.simple.seeder',[
            "class"=>$this->table_name
        ])->render();
    }

    protected function getTargetPath()
    {
        $name=$this->table_name."TableSeeder.php";
        return Configuration::get_project_path()."/database/seeds/".$name;
    }
}
