<?php
    use App\Definitions\MigrationType;
?>
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create{{\Illuminate\Support\Str::studly($class)}}Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('{{\Illuminate\Support\Str::snake($class)}}', function (Blueprint $table) {
            $table->bigIncrements('id');

@php

@endphp

@foreach($config as $name=>$rule)
        @php
            $method= \App\Helper::get_migration_config("method.".$rule['type']) ?? "string" ;
            $nullable=$rule['nullable'] ?? false ? '->nullable()':"";
            $unique=$rule['unique'] ?? false ? '->unique()':"";
            $length=$rule['length'] ??  \App\Helper::get_migration_config("default.".$rule['type']."-length") ?? "";
            $scale=$rule['scale'] ??  \App\Helper::get_migration_config("default.".$rule['type']."-scale") ?? "";
        @endphp
        @if($rule['type']===\App\Definitions\MigrationType::DECIMAL)
            $table->decimal('{{$name}}',{{$length}},{{$scale}}){!! $nullable !!}{!! $unique !!};
        @elseif($rule['type']===\App\Definitions\MigrationType::VARCHAR)
            $table->string('{{$name}}',{{$length}}){!! $nullable !!}{!! $unique !!};
        @elseif($rule['type']===\App\Definitions\MigrationType::DATETIME)
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
        Schema::dropIfExists('{{\Illuminate\Support\Str::snake($class)}}');
    }
}
