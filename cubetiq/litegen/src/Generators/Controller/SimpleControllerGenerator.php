<?php


namespace Cubetiq\Litegen\Generators\Controller;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Base\traits\OutputConsole;
use Cubetiq\Litegen\Base\traits\SubProjectContoller;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\ControllerGeneratorInterface;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class SimpleControllerGenerator extends BaseGeneratorRepository implements ControllerGeneratorInterface
{
    use OutputConsole;
    private $table_name;
    private $table_action;
    private $table_actions;

    const AVAILABLE_VIEW_ACTION=[
        "index",
        'create',
        'show',
        'edit'
    ];

    public function parse()
    {
        $controllers=Configuration::get_controllers_data();

        $this->table_actions=$controllers['actions'];

        foreach ($this->table_actions as $table=>$config){
            $this->table_name=$table;
            $this->table_action=$config;

            // Controller
            $temp=$this->config_for_controller();
            $output=$temp['output'];
            $content=$temp['content'];
            $this->generate($output,$content);
        }
    }

    private function config_for_controller(){
        $output=Str::studly($this->table_name)."Controller.php";
        $content="<?php".PHP_EOL.view('litegen::generator.controllers.controller_rest',[
                "class"=>$this->table_name,
                "config"=>$this->table_action
            ]);
        return [
            "output"=>Configuration::get_project_path()."/app/Http/Controllers/$output",
            "content"=>$content
        ];
    }



    private function config_for_resource(){
        $output=Str::studly($this->table_name)."Controller.php";
        $content="<?php".PHP_EOL.view('litegen::generator.controllers.controller_rest',[
                "class"=>$this->table_name,
                "config"=>$this->table_action
            ]);
        return [
            "output"=>$output,
            "content"=>$content
        ];
    }


}
