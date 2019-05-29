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
        Schema::table("{{\Illuminate\Support\Str::snake($config['from']['table'])}}",function (Blueprint $table){
            $table->unsignedBigInteger('{{$config['from']['column']}}')->nullable();
            $table->foreign('{{$config['from']['column']}}')->references('{{$config['to']['column']}}')->on('{{$config['to']['table']}}')
                ->onDelete('cascade');
        });
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
