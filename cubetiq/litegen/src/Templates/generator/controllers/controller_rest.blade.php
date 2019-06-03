@php
    $name=\Illuminate\Support\Str::studly($class);
    $class=\Illuminate\Support\Str::singular(\Illuminate\Support\Str::lower($name));
    $Class=\Illuminate\Support\Str::singular(\Illuminate\Support\Str::ucfirst($name));

    $classes=\Illuminate\Support\Str::lower(\Illuminate\Support\Str::plural($name));
    $Classes=\Illuminate\Support\Str::studly(\Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::plural($name)));

@endphp
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{{$name}};
use App\Repository\{{$Class}}\{{$Classes}}Interface;

class {{$Classes}}Controller extends Controller
{

    private ${{$class}}_repo;

    public function __construct({{$Classes}}Interface $repo){
        $this->{{$class}}_repo=$repo;
    }

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
        return view('{{$Class}}.create');
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
@if($config['edit'] ?? false)

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
    //
        $item=$this->{{$class}}_repo->findfirst($id);
        return view('{{$Class}}.edit',[
                "item"=>$item
            ]
        );
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
