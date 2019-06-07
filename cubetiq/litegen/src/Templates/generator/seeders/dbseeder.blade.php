
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        @foreach($names as $name)

        $this->call({{$name}}TableSeeder::class);
        @endforeach

    }
}
