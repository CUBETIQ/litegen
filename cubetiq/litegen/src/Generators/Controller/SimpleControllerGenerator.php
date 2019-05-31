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
    private $table_configs;

    public function parse()
    {
        $controllers=Configuration::get_controllers_data();

        $this->table_configs=$controllers;
        // Route
        $this->generate_route();


        foreach ($controllers as $table=>$config){
            $this->table_name=$table;
            $this->table_config=$config;

            $temp=$this->config_for_controller();
            $output=$temp['output'];
            $content=$temp['content'];

            $this->generate($output,$content);
        }
    }

    private function generate_route(){
        $temp=$this->config_for_route();
        $output=$temp['output'];
        $content=$temp['content'];

        $this->generate($output,$content);
    }

    private function config_for_controller(){
        $output=Str::studly($this->table_name)."Controller.php";
        $content="<?php".PHP_EOL.view('litegen::generator.controllers.controller_rest',[
                "class"=>$this->table_name,
                "config"=>$this->table_config
            ]);
        return [
            "output"=>Configuration::get_project_path()."/app/Http/Controllers/$output",
            "content"=>$content
        ];
    }

    private function config_for_view(){
        $output=Str::studly($this->table_name)."Controller.php";
        $content="<?php".PHP_EOL.view('litegen::generator.controllers.controller_rest',[
                "class"=>$this->table_name,
                "config"=>$this->table_config
            ]);
        return [
            "output"=>$output,
            "content"=>$content
        ];

    }

    private function config_for_route(){
        $output="web.php";
        $content="<?php".PHP_EOL.view('litegen::generator.routes.route_rest',[
                "configs"=>$this->table_configs
            ]);
        return [
            "output"=>Configuration::get_project_path()."/routes/$output",
            "content"=>$content
        ];
    }

    private function config_for_resource(){
        $output=Str::studly($this->table_name)."Controller.php";
        $content="<?php".PHP_EOL.view('litegen::generator.controllers.controller_rest',[
                "class"=>$this->table_name,
                "config"=>$this->table_config
            ]);
        return [
            "output"=>$output,
            "content"=>$content
        ];
    }


}
