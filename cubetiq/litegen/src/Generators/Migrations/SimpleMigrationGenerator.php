<?php


namespace Cubetiq\Litegen\Generators\Migrations;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Generators\FormatterInterface;
use Cubetiq\Litegen\Generators\MigrationGeneratorInterface;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;

class SimpleMigrationGenerator extends BaseGeneratorRepository implements MigrationGeneratorInterface
{
    private $files;
    private $formatter;

    public function __construct(Filesystem $fs,FormatterInterface $fm)
    {
        $this->formatter=$fm;
        $this->files = $fs;
        parent::__construct($fs);
    }

    protected function getTargetPath()
    {
        if ($this->current === 'create') {
            return Configuration::get_project_path()
                . "/database/migrations/" . Carbon::now()->format('Y_m_d_Hisu')
                . "_".$this->current."_$this->table_name" . "_table.php";
        } else {
            return Configuration::get_project_path()
                . "/database/migrations/" . Carbon::now()->format('Y_m_d_Hisu')
                . "_".$this->current."_". $this->table_config['from']['table']."_".$this->table_config['to']['table']  . "_relationship.php";
        }

    }

    public function parse()
    {
        $this->files->deleteDirectory(Configuration::get_project_path() . "/database/migrations");
        $configs = Configuration::getConfigData();
        $configs=$this->formatter->format_for_migration($configs);
        $this->process_all($configs);
    }

    /**
     * table name
     *
     * @var String
     */
    private $table_name;

    /**
     * Current table config
     *
     * @var array
     */
    private $table_config;

    /**
     * Current Process Type [ create | alter ]
     */
    private $current = "create";

    private function process_all($configs)
    {
        $tables = array_keys($configs['columns']);

        $this->current = "create";
        foreach ($tables as $table_name) {
            $this->process_column($table_name, $configs['columns'][$table_name]);
        }

        $this->current = "alter";
        foreach ($configs['relationships'] as $config) {
            $this->process_relationships($config);
        }
    }

    private function process_column($table_name, $config)
    {
        $this->table_name = $table_name;
        $this->table_config = $config;
        $this->generate();
    }


    protected function getContent()
    {
        if ($this->current === 'create') {
            $result = "<?php" . PHP_EOL . view('litegen::generator.migrations.migration_column', [
                    "config" => $this->table_config,
                    "class" => $this->table_name
                ])->render();
        } else {
            $result = "<?php" . PHP_EOL . view('litegen::generator.migrations.migration_relationship', [
                    "config" => $this->table_config,
                    "class" => $this->table_name
                ])->render();
        }
        return $result;
    }

//    private  function extract_line($template,$data){
//        preg_match_all('#\{(.*?)\}#', $template, $match);
//
//        for($i=0;$i<sizeof($match[0]);$i++){
//            $key=$match[1][$i];
//            if($data[$key] ?? false)
//                continue;
//            $data[$key]=Helper::get_migration_config("default.".$data['type']."-$key") ?? "";
//        }
//dd($template);
//        $result=str_replace($match[0],$data,$template);
//        return $result;
//    }

    public function process_relationships($relationship)
    {
//        $this->table_name = $table_name;
        $this->table_config = $relationship;
        $this->generate();
    }

}
