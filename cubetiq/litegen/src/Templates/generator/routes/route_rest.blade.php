use Illuminate\Support\Facades\Route;
    @foreach ($configs as $table=>$config)
    @php
        $controller=\Illuminate\Support\Str::studly(\Illuminate\Support\Str::plural($table));
        $name=\Illuminate\Support\Str::lower(\Illuminate\Support\Str::studly(\Illuminate\Support\Str::plural($table)));
    @endphp

    Route::group(["as"=>"{{$name}}.","prefix"=>"{{$name}}"],function (){
    @if($config['index'] ?? false)

        Route::get("/","{{$controller}}Controller@index")->name('index');
    @endif
    @if($config['create'] ?? false)

        Route::get("/create","{{$controller}}Controller@create")->name('create');
        Route::post("/","{{$controller}}Controller@store")->name('store');
    @endif
    @if($config['edit'] ?? false)

        Route::get("/edit/{id}","{{$controller}}Controller@edit")->name('edit');
        Route::put("/{id}","{{$controller}}Controller@update")->name('update');
    @endif
    @if($config['delete'] ?? false)

        Route::delete("/{id}","{{$controller}}Controller@destroy")->name('delete');
    @endif
    @if($config['show'] ?? false)

        Route::get("/{id}","{{$controller}}Controller{!!  "@"."show" !!}")->name('show');
    @endif

    });

    @endforeach
