use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Alter{{\Illuminate\Support\Str::studly($config['from']['table']."_".$config['to']['table'])}}Relationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        @if($config['type']===\Cubetiq\Litegen\Definitions\RelationshipType::ONE_TO_ONE)
        Schema::table("{{\Illuminate\Support\Str::snake($config['from']['table'])}}",function (Blueprint $table){
            $table->unsignedBigInteger('{{$config['from']['column']}}')->nullable();
            $table->foreign('{{$config['from']['column']}}')->references('{{$config['to']['column']}}')->on('{{$config['to']['table']}}')
                ->onDelete('cascade');
        });

        @elseif($config['type']===\Cubetiq\Litegen\Definitions\RelationshipType::ONE_TO_MANY)
        Schema::table("{{\Illuminate\Support\Str::snake($config['to']['table'])}}",function (Blueprint $table){
            $table->unsignedBigInteger('{{$config['to']['column']}}')->nullable();
            $table->foreign('{{$config['to']['column']}}')->references('{{$config['from']['column']}}')->on('{{$config['from']['table']}}')
            ->onDelete('cascade');
        });
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
        Schema::table('{{\Illuminate\Support\Str::snake($config['from']['table'])}}',function (Blueprint $table){
            $table->dropForeign(["staff_id"]);
        });
    }
}
