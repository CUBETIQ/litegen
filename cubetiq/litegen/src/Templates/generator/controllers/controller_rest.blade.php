@php
    $name=\Illuminate\Support\Str::studly($class);
    $class=\Illuminate\Support\Str::singular(\Illuminate\Support\Str::lower($name));
    $Class=\Illuminate\Support\Str::singular(\Illuminate\Support\Str::ucfirst($name));
    $classes=\Illuminate\Support\Str::plural($class);
    $Classes=\Illuminate\Support\Str::plural($class);
@endphp
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{{$name}};

class {{$Classes}}Controller extends Controller
{
@if($config['index'] ?? false)

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
    //
        ${{$classes}}={{$name}}::all();
        return view('{{$name}}.index',[
            "{{$classes}}"=>${{$classes}}
        ]);
    }

@endif
@if($config['create'] ?? false)

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
    //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    //
    }
@endif
@if($config['update'] ?? false)

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
    //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
    //
    }

@endif
@if($config['delete'] ?? false)

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
    //
    }
@endif
@if($config['show'] ?? false)

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
    //
    }
@endif











}
