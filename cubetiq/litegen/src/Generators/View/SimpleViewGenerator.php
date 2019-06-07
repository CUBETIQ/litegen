<?php


namespace Cubetiq\Litegen\Generators\View;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Definitions\RelationshipType;
use Cubetiq\Litegen\Generators\ViewGeneratorInterface;
use Cubetiq\Litegen\Support\Helper;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Symfony\Component\Routing\RouteCollection;

class SimpleViewGenerator extends BaseGeneratorRepository implements ViewGeneratorInterface
{
    private $table_name;
    private $table_action;
    private $table_actions;
    private $view_action;
    private $relationships;
    private $model;

    const AVAILABLE_VIEW_ACTION = [
        "index",
        'create',
        'show',
        'edit'
    ];

    private $files;
    public function __construct(Filesystem $fs)
    {
        $this->files=$fs;
        parent::__construct($fs);
    }

    public function parse()
    {
        $this->files->deleteDirectory(Configuration::get_project_path().'/resources/views/content');

        $controllers = Configuration::get_view_configData();

        $this->table_actions = $controllers['actions'];
        $this->view_action=$controllers['non-actions'];

        $models=Configuration::get_model_configData()['data'];

        foreach ($this->table_actions as $table => $config) {
            $this->relationships=array_reduce($models[$table],function ($result,$column){
                if($column['type']==RelationshipType::BELONGS_TO){
                    array_push($result,$column['table']);
                }
                return $result;
            },[]);

            $this->table_name = Helper::studly_singular($table);
            $this->table_action = $config;

            $this->model=$models[$table];
            // View
            $this->generate_view();
        }

        // For Non action View
        foreach ($this->view_action as $config){
            $this->table_name=Str::lower(Str::snake($config['view'] ?? $config['name']));
            $this->table_action=$config;
            $temp = $this->config_for_non_action();
            $output = $temp['output'];
            $content = $temp['content'];
            $this->generate($output, $content);
        }
//
//        // For Layout Side
//        $temp = $this->config_for_side();
//        $output = $temp['output'];
//        $content = $temp['content'];
//        $this->generate($output, $content);
//
//        // For Layout App
//        $temp = $this->config_for_app();
//        $output = $temp['output'];
//        $content = $temp['content'];
//        $this->generate($output, $content);


        Artisan::call('view:clear');
    }

    private function generate_view()
    {
        $action = $this->table_action;
        foreach ($action as $option => $result) {
            if (!in_array($option, self::AVAILABLE_VIEW_ACTION)) {
                continue;
            }
            if ($result == true) {
                $temp = $this->config_for_view($option);
                $output = $temp['output'];
                $content = $temp['content'];
                $this->generate($output, $content);
            }
        }
    }

    private function config_for_view($type)
    {
        $output = $type . ".blade.php";
        $content = view(config("litegen.views.$type","litegen::generator.views.rest.$type"), [
            "class" => $this->table_name,
            "action" => $this->table_action,
            "relates"=>$this->relationships,
            "model"=>$this->model
        ])->render();
        $table = $this->table_name;
        return [
            "output" => Configuration::get_project_path() . "/resources/views/content/$table/$output",
            "content" => $content
        ];
    }

    private function config_for_non_action()
    {
        $output = $this->table_name . ".blade.php";
        $content = view("litegen::generator.views.non_action", [
            "class" => $this->table_name,
            "config" => $this->table_action
        ])->render();
//        $table = Str::lower($this->table_name);
        return [
            "output" => Configuration::get_project_path() . "/resources/views/content/$output",
            "content" => $content
        ];
    }


    private function config_for_side()
    {
        $output =  "side.blade.php";
        $content = view("litegen::generator.views.layouts.side", [
            "actions" => $this->table_actions,
            "views"=>$this->view_action
        ])->render();
//        $table = Str::lower($this->table_name);
        return [
            "output" => Configuration::get_project_path() . "/resources/views/layouts/$output",
            "content" => $content
        ];
    }

    private function config_for_app()
    {
        $output =  "app.blade.php";
        $content = view("litegen::generator.views.layouts.app", [
            "actions" => $this->table_actions,
            "views"=>$this->view_action
        ])->render();
//        $table = Str::lower($this->table_name);
        return [
            "output" => Configuration::get_project_path() . "/resources/views/layouts/$output",
            "content" => $content
        ];
    }

}
