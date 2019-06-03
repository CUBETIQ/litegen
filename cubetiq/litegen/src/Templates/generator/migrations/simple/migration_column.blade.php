<?php
    use Cubetiq\Litegen\Definitions\MigrationType;
    use Cubetiq\Litegen\Support\Helper;
?>
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create{{\Illuminate\Support\Str::studly(\Cubetiq\Litegen\Support\Helper::db_tname_format($class))}}Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('{{\Cubetiq\Litegen\Support\Helper::db_tname_format($class)}}', function (Blueprint $table) {
            $table->bigIncrements('id');

@php

@endphp

@foreach($config as $name=>$rule)
        @php
            $method= Helper::get_migration_config("method.".$rule['type']) ?? "string" ;
            $nullable=$rule['nullable'] ?? false ? '->nullable()':"";
            $unique=$rule['unique'] ?? false ? '->unique()':"";
            $length=$rule['length'] ??  Helper::get_migration_config("default.".$rule['type']."-length") ?? "";
            $scale=$rule['scale'] ??  Helper::get_migration_config("default.".$rule['type']."-scale") ?? "";
        @endphp
        @if($rule['type']===MigrationType::DECIMAL)
            $table->decimal('{{$name}}',{{$length}},{{$scale}}){!! $nullable !!}{!! $unique !!};
        @elseif($rule['type']===MigrationType::VARCHAR)
            $table->string('{{$name}}',{{$length}}){!! $nullable !!}{!! $unique !!};
        @elseif($rule['type']===MigrationType::DATETIME)
            $table->datetime('{{$name}}');
        @endif

@endforeach
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('{{\Illuminate\Support\Str::snake(\Illuminate\Support\Str::plural($class))}}');
    }
}
