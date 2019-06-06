use Illuminate\Database\Seeder;

class {{$class}}TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\{{\Illuminate\Support\Str::singular($class)}}::class,10)->create([

        ]);
        //
    }
}
