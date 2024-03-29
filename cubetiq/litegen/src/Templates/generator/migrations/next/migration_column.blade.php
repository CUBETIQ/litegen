<?php
    use Cubetiq\Litegen\Definitions\MigrationType;
    use Cubetiq\Litegen\Support\Helper;

    $Classes=\Illuminate\Support\Str::studly(\Illuminate\Support\Str::plural($name));
    $classes=\Illuminate\Support\Str::snake(\Illuminate\Support\Str::plural($name));
?>
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create{{$Classes}}Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('{{$classes}}', function (Blueprint $table) {
            $table->bigIncrements('id');

@php

@endphp

@foreach($columns as $column=>$rule)
        @php
            $nullable=$rule['nullable'] ?? false ? '->nullable()':"";
            $unique=$rule['unique'] ?? false ? '->unique()':"";
            $default=$rule['default'] ?? false ? '->default('.$rule['default'].')':"";
        @endphp

        @if($rule['type']===\Cubetiq\Litegen\Definitions\ModelType::DECIMAL)

            $table->decimal('{{$column}}',{{$rule['length']}},{{$rule['scale']}}){!! $nullable !!}{!! $unique !!}{!! $default !!};
        @elseif($rule['type']===\Cubetiq\Litegen\Definitions\ModelType::TEXT)

            $table->string('{{$column}}',{{$rule['length']}}){!! $nullable !!}{!! $unique !!}{!! $default !!};
        @elseif($rule['type']===\Cubetiq\Litegen\Definitions\ModelType::DATETIME)

            $table->datetime('{{$column}}'){!! $nullable !!}{!! $unique !!}{!! $default !!};
        @elseif($rule['type']===\Cubetiq\Litegen\Definitions\ModelType::INTEGER)

            $table->bigInteger("{{$column}}"){!! $nullable !!}{!! $unique !!}{!! $default !!};
        @elseif($rule['type']===\Cubetiq\Litegen\Definitions\ModelType::TEXTAREA)

            $table->text("{{$column}}"){!! $nullable !!}{!! $unique !!}{!! $default !!};
        @elseif($rule['type']===\Cubetiq\Litegen\Definitions\ModelType::BOOLEAN)

            $table->boolean("{{$column}}"){!! $nullable !!}{!! $unique !!}{!! $default !!};
        @else

        @endif

@endforeach

@if($meta['timestamps'])

            $table->timestamps();
@endif

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('{{$classes}}');
    }
}
