
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class {{$class}}UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
@php
    $cons=new ReflectionClass(\Cubetiq\Litegen\Definitions\ModelType::class);
    $model_type=$cons->getConstants();
    $table_name=\Illuminate\Support\Str::snake(\Illuminate\Support\Str::plural($class));
@endphp

        return [
    @foreach($columns as $column=>$config)
        @php
            if(in_array($config['type'],$model_type)){
                $column_name=$column;
            }elseif (in_array($config['type'],[\Cubetiq\Litegen\Definitions\RelationshipType::BELONGS_TO])){
                $column_name=$config['foreign'];
            }else{
                continue;
            }
            $options=[];
            if(!$config['nullable']){
                array_push($options,"required");
            }
        @endphp
            "{{$column_name}}"=>"{!! implode("|",$options) !!}",
    @endforeach

        ];
    }
}
