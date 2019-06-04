<?php


namespace Cubetiq\Litegen\Generators\Controller;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Base\traits\OutputConsole;
use Cubetiq\Litegen\Base\traits\SubProjectContoller;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Definitions\ModelType;
use Cubetiq\Litegen\Definitions\RelationshipType;
use Cubetiq\Litegen\Generators\ControllerGeneratorInterface;
use Cubetiq\Litegen\Support\Helper;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class SimpleControllerGenerator extends BaseGeneratorRepository implements ControllerGeneratorInterface
{
    use OutputConsole;
    private $table_name;
    private $table_action;
    private $table_actions;

    private $model_columns;

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

        $this->generate_for_requests();


        foreach ($this->table_actions as $table=>$config){
            $this->table_name=Helper::studly_singular($table);
            $this->table_action=$config;

            // Controller
            $temp=$this->config_for_controller();
            $output=$temp['output'];
            $content=$temp['content'];
            $this->generate($output,$content);

            // Request

            // Repository
            $this->generate_for_repository();
        }

        $this->generate_provider();
    }

    private function generate_for_repository(){
        $temp=$this->config_for_repository();
        $output=$temp['output'];
        $content=$temp['content'];
        $this->generate($output,$content);

        $temp=$this->config_for_interface();
        $output=$temp['output'];
        $content=$temp['content'];
        $this->generate($output,$content);
    }

    private function config_for_repository(){
        $output=Str::plural($this->table_name)."Repository.php";
        $content="<?php".PHP_EOL.view('litegen::generator.repository.repository',[
                "class"=>$this->table_name,
                "config"=>$this->table_action
            ]);
        return [
            "output"=>Configuration::get_project_path()."/app/Http/Repository/$this->table_name/$output",
            "content"=>$content
        ];
    }

    private function config_for_interface(){
        $output=Str::plural($this->table_name)."Interface.php";
        $content="<?php".PHP_EOL.view('litegen::generator.repository.interface',[
                "class"=>$this->table_name,
                "config"=>$this->table_action
            ]);
        return [
            "output"=>Configuration::get_project_path()."/app/Http/Repository/$this->table_name/$output",
            "content"=>$content
        ];
    }

    private function  generate_for_requests(){
        $models=Configuration::get_model_configData()['data'];
        foreach ($models as $table=>$columns){
            $this->table_name=Helper::studly_singular($table);
            $this->model_columns=$columns;

            $temp=$this->config_for_store_request();
            $output=$temp['output'];
            $content=$temp['content'];
            $this->generate($output,$content);

            $temp=$this->config_for_update_request();
            $output=$temp['output'];
            $content=$temp['content'];
            $this->generate($output,$content);
        }
    }

    private function config_for_controller(){
        $output=Str::plural($this->table_name)."Controller.php";
        $content="<?php".PHP_EOL.view('litegen::generator.controllers.controller_rest',[
                "class"=>$this->table_name,
                "config"=>$this->table_action
            ]);
        return [
            "output"=>Configuration::get_project_path()."/app/Http/Controllers/$output",
            "content"=>$content
        ];
    }


    private function config_for_store_request(){
        $table=Str::plural(Str::snake($this->table_name));

        $output=$this->table_name."StoreRequest.php";
        $content="<?php".PHP_EOL.view('litegen::generator.requests.simple.store',[
                "class"=>$this->table_name,
                "columns"=>$this->model_columns
            ])->render();
        return [
            "output"=>Configuration::get_project_path()."/app/Http/Requests/$this->table_name/$output",
            "content"=>$content
        ];
    }

    private function config_for_update_request(){
        $table=Str::plural(Str::snake($this->table_name));

        $output=$this->table_name."UpdateRequest.php";
        $content="<?php".PHP_EOL.view('litegen::generator.requests.simple.update',[
                "class"=>$this->table_name,
                "columns"=>$this->model_columns
            ])->render();
        return [
            "output"=>Configuration::get_project_path()."/app/Http/Requests/$this->table_name/$output",
            "content"=>$content
        ];
    }


//    private function config_for_resource(){
//        $output=$this->table_name."Controller.php";
//        $content="<?php".PHP_EOL.view('litegen::generator.controllers.controller_rest',[
//                "class"=>$this->table_name,
//                "config"=>$this->table_action
//            ]);
//        return [
//            "output"=>$output,
//            "content"=>$content
//        ];
//    }

    private function generate_provider(){
        $tables=array_keys($this->table_actions);
        $content="<?php".PHP_EOL.view('litegen::generator.repository.provider',[
                "tables"=>$tables,
            ])->render();
        $path=Configuration::get_project_path()."/app/Providers/RepositoryInterfaceProvider.php";
        $this->generate($path,$content);
    }

//    private function get_fillable_columns($columns){
//        $cons=new \ReflectionClass(ModelType::class);
//        $modtype=$cons->getConstants();
//        $modtype['belongto']=RelationshipType::BELONGS_TO;
//
//        $fillable=[];
//        foreach ($columns as $name=>$config){
//            if (!in_array($config['type'],$modtype))
//                continue;
//            if($config['type']==RelationshipType::BELONGS_TO){
//                array_push($fillable,$config['foreign']);
//                continue;
//            }
//            array_push($fillable,$name);
//        }
//        return $fillable;
//    }
}
