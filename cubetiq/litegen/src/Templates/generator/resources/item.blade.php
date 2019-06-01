@php


@endphp

namespace App\Http\Resources;

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

                '{!! json_encode($resource[$column]) !!}',
                "{{$column}}"=>$this->{{$column}},

            @endforeach

        ];
        return parent::toArray($request);
    }
}
