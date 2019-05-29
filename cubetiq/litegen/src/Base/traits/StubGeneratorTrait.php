<?php


namespace Cubetiq\Litegen\Base\traits;


use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Log;

trait StubGeneratorTrait
{
    use OutputConsole;

    private $files;
    public function __construct(Filesystem $fs)
    {
        $this->files=$fs;
    }

    /**
     * Return Target Path
     *
     * @return String
     * @throws \Exception
     */
    protected function getTargetPath(){
        throw new \Exception("Not Implement Target file path");
    }

    /**
     * Return Content
     *
     * @return String
     * @throws \Exception
     */
    protected function getContent(){
        throw new \Exception("Not Implement Content");
    }

    /**
     * Generate File
     *
     * @throws \Exception
     */
    protected function generate()
    {
        $output_path=$this->getTargetPath();
        $content=$this->getContent();

        if ($this->files->exists($output_path)) {
            $this->info_msg($output_path . " is existed , Override !");
        }
        $this->makeDirectory($output_path);

        $this->files->put($output_path, $content);

        $this->info_msg("finish !");
    }

    /**
     * Check if Directory of is exist and create
     *
     * @param string $path
     * @param string $delimiter
     */
    protected function makeDirectory(string $path, string $delimiter = "/")
    {
        $dirs = explode($delimiter, $path);
        array_pop($dirs);
        $dir_path = "";
        foreach ($dirs as $dir) {
            $dir_path = $dir_path . $dir . "/";
            if (!$this->files->exists($dir_path)) {
                $this->info_msg($dir_path . " is not exist , Creating");
                $this->files->makeDirectory($dir_path);
                $this->info_msg($dir_path . "  Created \n");

            }

        }
    }
}
