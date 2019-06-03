<?php


namespace Cubetiq\Litegen\Generators\Migrations;


use Cubetiq\Litegen\Base\BaseGeneratorRepository;
use Cubetiq\Litegen\Configuration;
use Cubetiq\Litegen\Definitions\ModelType;
use Cubetiq\Litegen\Generators\MigrationGeneratorInterface;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class NextMigrationGenerator extends BaseGeneratorRepository implements MigrationGeneratorInterface
{
    const RETATIONSHIP_CREATE = [
        ModelType::BELONGS_TO
    ];

    private $table_name;
    private $table_config;

    private $files;

    public function __construct(Filesystem $fs)
    {
        $this->files = $fs;
        parent::__construct($fs);
    }


    public function parse()
    {
        $this->files->deleteDirectory(Configuration::get_project_path() . "/database/migrations");

        $configs = Configuration::get_migration_configData();

        // Columns
        foreach ($configs['data'] as $table => $columns) {

            $this->table_name = Str::plural(Str::snake($table));
            $this->table_config = $columns;

            $temp = $this->config_for_columns();
            $output = $temp['output'];
            $content = $temp['content'];
            $this->generate($output, $content);
        }

        // Relationship
        foreach ($configs['data'] as $table => $columns) {
            $outside_column=array_filter($columns,function ($column){
                return in_array($column['type'],self::RETATIONSHIP_CREATE);
            });

            foreach ($outside_column as $column=>$config){
                $this->table_name = Str::plural(Str::snake($table));
                $this->table_config = $config;

                $temp = $this->config_for_relationship();
                $output = $temp['output'];
                $content = $temp['content'];
                $this->generate($output, $content);
            };

        }


    }

    private function config_for_relationship()
    {
        $name = Str::singular(Str::lower($this->table_name));
        $foreign_name=Str::plural(Str::snake($this->table_config['table']));
        $output = Carbon::now()->format('Y_m_d_Hisu') . "_alter_" .$this->table_name."_".$foreign_name . "_relationship.php";
        $content = "<?php" . PHP_EOL . view('litegen::generator.migrations.next.migration_relationship', [
                "name" => $name,
                "config" => $this->table_config,
                "foreign"=>Str::singular(Str::snake($this->table_config['table'])),
        ])->render();
        return [
            "output" => Configuration::get_project_path() . "/database/migrations/" . $output,
            "content" => $content
        ];
    }

    private function config_for_columns()
    {
        $name = Str::singular(Str::lower($this->table_name));
        $output = Carbon::now()->format('Y_m_d_Hisu') . "_create_" . $this->table_name . "_table.php";
        $content = "<?php" . PHP_EOL . view('litegen::generator.migrations.next.migration_column', [
                "name" => $name,
                "columns" => $this->table_config
            ])->render();
        return [
            "output" => Configuration::get_project_path() . "/database/migrations/" . $output,
            "content" => $content
        ];
    }
}
