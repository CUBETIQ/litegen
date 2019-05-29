<?php


namespace Cubetiq\Litegen\Base;


use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class BaseCommand  extends Command
{

    /**
     * Use to run Shell command
     *
     * @param $command
     * @return Process
     */
    public function processCommand($command){
        $this->info("start excute : ".$command);

        $process=new Process($command);
        $process->setTimeout(0);
        $process->start();
        $process->wait(function ($type,$buffer){
            $this->info("OUT > ".$buffer);
        });

        $this->info("Process end!");
        return $process;
    }

    /**
     * use for get path of sub project
     *
     * @param String $project_name
     * @return string
     */
    public function subproject_basedir(String $project_name){
        return env("GENERATED_PROJECT_PATH").$project_name;
    }

    /**
     * use for run artisan command for sub project
     *
     * @param String $project_name
     * @param String $command
     * @return Process
     */
    public function sub_artisan(String $project_name,String $command){
        $temp = $this->processCommand("php ".$this->subproject_basedir($project_name).'artisan '.$command);
        return $temp;
    }
}
