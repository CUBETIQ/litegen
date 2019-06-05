<?php


namespace Cubetiq\Litegen\Base\traits;


use Cubetiq\Litegen\Configuration;

trait SubProjectContoller
{

//    private $project_name;
//
//    protected function ProjectPath(){
//        $project_name=$this->getProjectname();
//
//        return $newPath;
//    }
//
//    protected function StorePath(){
//        return "";
//    }
//
//    /**
//     * Get Project name
//     *
//     * @return String
//     * @throws \Exception
//     */
//    protected function getProjectname(){
//        $name=Configuration::getProjectname();
//
//        $this->project_name=$name;
//
//        if($this->project_name)
//            return $this->project_name;
//        throw new \Exception("Not Implement Projectname");
//    }
//
    protected function isProjectExist(){
        return file_exists(Configuration::get_project_path());
    }
}
