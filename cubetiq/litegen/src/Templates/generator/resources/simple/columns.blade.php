@php


        @endphp

namespace App\Resources\{{$class}};

use Illuminate\Http\Resources\Json\JsonResource;

class {{$class}}Resource extends JsonResource
{
/**
* Transform the resource into an array.
*
* @param  \Illuminate\Http\Request  $request
* @return array
*/
public function toArray($request)
{
return [

@foreach($columns as $column)
    @php
        $config=$resource[$column];
        $cons=new ReflectionClass(\Cubetiq\Litegen\Definitions\ModelType::class);
        $model_type=$cons->getConstants();
    @endphp
    @if(in_array($config['type'],$model_type))

        "{{$column}}"=>$this->{{$column}},
    @else
        @php
            $Foreigns=\Illuminate\Support\Str::plural(\Illuminate\Support\Str::studly($config['table']));
            $Foreign=\Illuminate\Support\Str::singular(\Illuminate\Support\Str::studly($config['table']));
        @endphp
        @if(in_array($config['type'],[\Cubetiq\Litegen\Definitions\RelationshipType::BELONGS_TO,\Cubetiq\Litegen\Definitions\RelationshipType::HAS_ONE]))

        "{{$column}}"=>new \App\Resources\{{$Foreign}}\{{$Foreign}}Relationship($this->{{$Foreign}}),
        @else

        "{{$column}}"=>\App\Resources\{{$Foreign}}\{{$Foreign}}Relationship::collection(collect($this->{{$Foreigns}})),
        @endif
    @endif
@endforeach

];
}
}
