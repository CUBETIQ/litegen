<?php


namespace Cubetiq\Litegen\Generators\View;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\ViewGeneratorInterface;
use Cubetiq\Litegen\Support\Helper;
use Illuminate\Support\Str;

class SimpleViewGenerator extends BaseGeneratorRepository implements ViewGeneratorInterface
{
    private $table_name;
    private $table_action;
    private $table_actions;
    private $view_action;

    const AVAILABLE_VIEW_ACTION = [
        "index",
        'create',
        'show',
        'edit'
    ];

    public function parse()
    {
        $controllers = Configuration::get_view_configData();

        $this->table_actions = $controllers['actions'];
        $this->view_action=$controllers['non-actions'];

        foreach ($this->table_actions as $table => $config) {
            $this->table_name = Helper::studly_singular($table);
            $this->table_action = $config;

            // View
            $this->generate_view();
        }

        // For Non action View
        foreach ($this->view_action as $config){
            $this->table_name=Str::lower(Str::snake($config['name']));
            $this->table_action=$config;
            $temp = $this->config_for_non_action();
            $output = $temp['output'];
            $content = $temp['content'];
            $this->generate($output, $content);
        }


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
        $content = view("litegen::generator.views.rest.$type", [
            "class" => $this->table_name,
            "config" => $this->table_action
        ]);
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
        ]);
//        $table = Str::lower($this->table_name);
        return [
            "output" => Configuration::get_project_path() . "/resources/views/content/$output",
            "content" => $content
        ];
    }
}
