@php


        @endphp

namespace App\Resources\{{$class}};

use Illuminate\Http\Resources\Json\JsonResource;

class {{$class}}Relationship extends JsonResource
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

        @endif
    @endforeach

        ];
    return parent::toArray($request);
    }
}
