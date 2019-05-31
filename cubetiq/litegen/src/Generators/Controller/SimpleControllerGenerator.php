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
        // Route
        $this->generate_route();


        foreach ($this->table_actions as $table=>$config){
            $this->table_name=$table;
            $this->table_action=$config;

            // Controller
            $temp=$this->config_for_controller();
            $output=$temp['output'];
            $content=$temp['content'];
            $this->generate($output,$content);
            
            // View
            $this->generate_view();
            
        }
    }

    private function generate_view(){
        $action=$this->table_action;
        foreach ($action as $option=>$result){
            if(!in_array($option,self::AVAILABLE_VIEW_ACTION)){
                $this->info_msg($this->table_name."-".$option);
                continue;
            }
            if($result == true){
                $temp=$this->config_for_view($option);
                $output=$temp['output'];
                $content=$temp['content'];
                $this->generate($output,$content);
            }
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
                "config"=>$this->table_action
            ]);
        return [
            "output"=>Configuration::get_project_path()."/app/Http/Controllers/$output",
            "content"=>$content
        ];
    }

    private function config_for_view($type){
        $output=$type.".blade.php";
        $content=view("litegen::generator.views.rest.$type",[
                "class"=>$this->table_name,
                "config"=>$this->table_action
            ]);
        $table=Str::studly($this->table_name);
        return [
            "output"=>Configuration::get_project_path()."/resources/views/$table/$output",
            "content"=>$content
        ];

    }

    private function config_for_route(){
        $output="web.php";
        $content="<?php".PHP_EOL.view('litegen::generator.routes.route_rest',[
                "configs"=>$this->table_actions
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
                "config"=>$this->table_action
            ]);
        return [
            "output"=>$output,
            "content"=>$content
        ];
    }


}
