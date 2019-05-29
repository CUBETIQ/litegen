<?php


namespace Cubetiq\Litegen\Base\traits;


use Symfony\Component\Console\Output\ConsoleOutput;

trait OutputConsole
{
    private $console_output;

    private function getConsoleOutput(){
        if(!$this->console_output)
            $this->console_output=new ConsoleOutput();
        return $this->console_output;
    }

    protected function info_msg(String $message){
        $str="<info>$message</info>";
        $this->getConsoleOutput()->writeln($str);
    }
}
