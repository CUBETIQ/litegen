@php
    $name=\Illuminate\Support\Str::studly($class);
    $class=\Illuminate\Support\Str::singular(\Illuminate\Support\Str::lower($name));
    $Class=\Illuminate\Support\Str::singular(\Illuminate\Support\Str::studly($name));

    $classes=\Illuminate\Support\Str::lower(\Illuminate\Support\Str::plural($name));
    $Classes=\Illuminate\Support\Str::studly(\Illuminate\Support\Str::plural($name));

@endphp
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{{$name}};
use App\Repository\{{$Class}}\{{$Classes}}Interface;
use App\Resources\{{$Class}}\{{$Class}}Resource;
use App\Http\Requests\{{$Class}}StoreRequest;
use App\Http\Requests\{{$Class}}UpdateRequest;


class {{$Classes}}Controller extends Controller
{
    const FILLABLE=[{!!  sizeof($fillable)?"\"".implode("\",\"",$fillable)."\"":"" !!}];

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
        ${{$classes}}=$this->{{$class}}_repo->all();
        return view('content.{{$name}}.index',[
            "{{$classes}}"=>{{$Class}}Resource::collection(${{$classes}})
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
        return view('content.{{$Class}}.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store({{$Class}}StoreRequest $request)
    {
    //
        $required_data=$request->all(self::FILLABLE);
        $addition_data=[

        ];
        $full_data=array_merge($required_data,$addition_data);
        $filtered=array_filter($full_data);
        $result=$this->{{$class}}_repo->create($filtered);
        if($request->wantsJson()){
            return response()->json(
                new {{$Class}}Resource($result)
            );
        }
        return redirect()->route('content.{{$classes}}.index');
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
        return view('content.{{$Class}}.edit',[
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
    public function update({{$Class}}UpdateRequest $request, $id)
    {
    //
        $required_data=$request->all(self::FILLABLE);
        $addition_data=[

        ];
        $full_data=array_merge($required_data,$addition_data);
        $filtered=array_filter($full_data);
        $result=$this->{{$class}}_repo->update($id,$filtered);
        if($request->wantsJson()){
            return response()->json(
                    new {{$Class}}Resource($result)
                );
        }
        return redirect()->route('content.{{$classes}}.index');
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
        $item=$this->{{$class}}_repo->findfirst($id);
        return view('content.{{$Class}}.show',[
            "item"=> new {{$Class}}Resource($item)
            ]
        );
    //
    }
@endif











}
