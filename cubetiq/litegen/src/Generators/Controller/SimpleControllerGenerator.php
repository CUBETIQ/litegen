<?php


namespace Cubetiq\Litegen\Generators\Controller;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Base\traits\OutputConsole;
use Cubetiq\Litegen\Base\traits\SubProjectContoller;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\ControllerGeneratorInterface;
use Illuminate\Support\Str;

class SimpleControllerGenerator extends BaseGeneratorRepository implements ControllerGeneratorInterface
{
    use OutputConsole;
    private $table_name;
    private $table_config;

    public function parse()
    {
        $controllers=Configuration::get_controllers_data();
        foreach ($controllers as $table=>$config){
            $this->table_name=$table;
            $this->table_config=$config;
            $this->generate();
        }
    }

    protected function getContent()
    {
        return "<?php".PHP_EOL.view('litegen::generator.controllers.controller_rest',[
            "class"=>$this->table_name,
            "config"=>$this->table_config
        ]);
    }

    protected function getTargetPath()
    {
        $name=Str::studly($this->table_name)."Controller.php";
        return Configuration::get_project_path()."/app/Http/Controllers/$name";
    }
}
