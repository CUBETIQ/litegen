use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

@php

$Classes=\Illuminate\Support\Str::studly(\Illuminate\Support\Str::plural($name));
$classes=\Illuminate\Support\Str::snake(\Illuminate\Support\Str::plural($name));
$Foreigns=\Illuminate\Support\Str::studly(\Illuminate\Support\Str::plural($foreign));
$foreigns=\Illuminate\Support\Str::snake(\Illuminate\Support\Str::plural($foreign));

@endphp

class Alter{{$Classes.$Foreigns}}Relationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        @if($config['type']===\Cubetiq\Litegen\Definitions\ModelType::BELONGS_TO)

            Schema::table("{{$classes}}",function (Blueprint $table){
                $table->unsignedBigInteger('{{$config['foreign']}}')->nullable();
                $table->foreign('{{$config['foreign']}}')->references('{{$config['column']}}')->on('{{$foreigns}}')
                    ->onDelete('cascade');
            });

{{--        @elseif($config['type']===\Cubetiq\Litegen\Definitions\ModelType::HAS_MANY)--}}
{{--            Schema::table("{{$classes}}",function (Blueprint $table){--}}
{{--                $table->unsignedBigInteger('{{$config['foreign']}}')->nullable();--}}
{{--                $table->foreign('{{$config['foreign']}}')->references('{{$config['column']}}')->on('{{$foreigns}}')--}}
{{--                ->onDelete('cascade');--}}
{{--            });--}}
        @endif

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('{{$classes}}',function (Blueprint $table){
            $table->dropForeign(["{{$config['foreign']}}"]);
        });
    }
}
