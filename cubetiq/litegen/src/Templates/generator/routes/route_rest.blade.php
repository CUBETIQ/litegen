use Illuminate\Support\Facades\Route;
    @foreach ($configs as $table=>$config)
    @php
        $name=\Illuminate\Support\Str::lower(\Illuminate\Support\Str::studly(\Illuminate\Support\Str::plural($table)));
    @endphp

    Route::group(["as"=>"{{$name}}.","prefix"=>"{{$name}}"],function (){
    @if($config['index'] ?? false)

        Route::get("/","{{\Illuminate\Support\Str::ucfirst($name)}}Controller@index")->name('index');

    @endif
    @if($config['show'] ?? false)

        Route::get("/{id}","{{\Illuminate\Support\Str::ucfirst($name)}}Controller{!!  "@"."show" !!}")->name('show');

    @endif
    @if($config['create'] ?? false)

        Route::get("/create","{{\Illuminate\Support\Str::ucfirst($name)}}Controller@create")->name('create');
        Route::post("/","{{\Illuminate\Support\Str::ucfirst($name)}}Controller@store")->name('store');

    @endif
    @if($config['edit'] ?? false)

        Route::get("/edit/{id}","{{\Illuminate\Support\Str::ucfirst($name)}}Controller@edit")->name('edit');
        Route::put("/{id}","{{\Illuminate\Support\Str::ucfirst($name)}}Controller@update")->name('update');

    @endif
    @if($config['delete'] ?? false)

        Route::delete("/{id}","{{\Illuminate\Support\Str::ucfirst($name)}}Controller@destroy")->name('delete');

    @endif


    });

    @endforeach
