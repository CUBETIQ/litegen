
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
@foreach($tables as $table)
    @php
        $name=\Illuminate\Support\Str::studly(\Illuminate\Support\Str::plural($table));
    @endphp
use App\Repository\{{\Illuminate\Support\Str::singular($name)}}\{{$name}}Repository;
use App\Repository\{{\Illuminate\Support\Str::singular($name)}}\{{$name}}Interface;
@endforeach

class RepositoryInterfaceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        @foreach($tables as $table)
            @php
                $name=\Illuminate\Support\Str::studly(\Illuminate\Support\Str::plural($table));
            @endphp

        $this->app->bind({{$name}}Interface::class,{{$name}}Repository::class);
        @endforeach

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
