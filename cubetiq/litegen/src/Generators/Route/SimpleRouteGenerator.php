<?php


namespace Cubetiq\Litegen\Generators\Route;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\RouteGeneratorInterface;

class SimpleRouteGenerator extends BaseGeneratorRepository implements RouteGeneratorInterface
{
    protected function getContent()
    {
        $controllers=Configuration::get_route_configData();
        $table_actions=$controllers['actions'];
        $view_non_actions=$controllers['non-actions'];
        $content="<?php".PHP_EOL.view('litegen::generator.routes.route_rest',[
                "configs"=>$table_actions,
                'nons'=>$view_non_actions
            ])->render();
        return $content;
    }

    protected function getTargetPath()
    {
        $output="web.php";
        return Configuration::get_project_path()."/routes/$output";

    }
}
