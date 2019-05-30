<?php


namespace Cubetiq\Litegen\Generators\Models;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\FormatterInterface;
use Cubetiq\Litegen\Generators\ModelGeneratorInterface;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class SimpleModelGenerator extends BaseGeneratorRepository implements ModelGeneratorInterface
{
    private $formatter;
    private $tablename=null;

    public function __construct(Filesystem $fs,FormatterInterface $frm)
    {
        $this->formatter=$frm;
        parent::__construct($fs);
    }

    public function parse()
    {
        $configs=Configuration::getConfigData();
        $configs=$this->formatter->format_for_model($configs);
        dd($configs);
        foreach ($configs['columns'] as $table=>$config){
            $this->tablename=$table;
            $this->generate();
        }
    }
    protected function getTargetPath()
    {
        $project_path=Configuration::get_project_path();
        $target=$project_path."/app/Models/".Str::studly($this->tablename).".php";
        return $target;
    }
    protected function getContent()
    {
        return view('litegen::generator.models.model_template');
    }
}
