namespace App\Models;

use App\Base\BaseModel;
@php
    $Class=\Illuminate\Support\Str::studly(\Illuminate\Support\Str::singular($name));
    $classes=\Illuminate\Support\Str::snake(\Illuminate\Support\Str::plural($name));

@endphp

class {{$Class}} extends BaseModel
{
    protected $table="{{$classes}}";

    protected $fillable=[{!!  sizeof($fillable)?"\"".implode("\",\"",$fillable)."\"":"" !!}];

    @foreach($relationships as $column_name=>$config)


        @if($config['type']==\Cubetiq\Litegen\Definitions\ModelType::HAS_MANY)

        public function {{\Illuminate\Support\Str::studly(\Illuminate\Support\Str::plural($config['table']))}}()
        {
            return $this->hasMany({{\Cubetiq\Litegen\Support\Helper::studly_singular($config['table'])}}::class,'{{$config['column']}}');
        }
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\ModelType::HAS_ONE)

        public function {{\Illuminate\Support\Str::studly(\Illuminate\Support\Str::singular($config['table']))}}()
        {
            return $this->hasOne({{\Cubetiq\Litegen\Support\Helper::studly_singular($config['table'])}}::class,'{{$config['foreign']}}');
        }
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\ModelType::BELONGS_TO)

        public function {{\Illuminate\Support\Str::studly(\Illuminate\Support\Str::singular($config['table']))}}()
        {
            return $this->BelongsTo({{\Cubetiq\Litegen\Support\Helper::studly_singular($config['table'])}}::class,'{{$config['foreign']}}');
        }
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\ModelType::BELONGSTOMANY)

        public function {{\Illuminate\Support\Str::studly(\Illuminate\Support\Str::plural($config['table']))}}()
        {
            return $this->BelongsTo({{\Cubetiq\Litegen\Support\Helper::studly_singular($config['table'])}}::class,'{{$config['through']['table']}}');
        }
        @endif


    @endforeach

}
