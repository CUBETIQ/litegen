namespace App\Models;

use App\Base\BaseModel;
@php
    $Class=\Illuminate\Support\Str::studly(\Illuminate\Support\Str::singular($name));
    $classes=\Illuminate\Support\Str::snake(\Illuminate\Support\Str::plural($name));

@endphp

class {{$Class}} extends BaseModel
{
    public $timestamps={!!  $meta['timestamps']?"true":"false" !!};

    protected $table="{{$classes}}";

    protected $fillable=[{!!  sizeof($fillable)?"\"".implode("\",\"",$fillable)."\"":"" !!}];

    @foreach($relationships as $column_name=>$config)
        @if($config['type']==\Cubetiq\Litegen\Definitions\RelationshipType::HAS_MANY)

        public function {{\Illuminate\Support\Str::studly(\Illuminate\Support\Str::plural($config['table']))}}()
        {
            return $this->hasMany({{\Cubetiq\Litegen\Support\Helper::studly_singular($config['table'])}}::class,'{{$config['column']}}');
        }
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\RelationshipType::HAS_ONE)

        public function {{\Illuminate\Support\Str::studly(\Illuminate\Support\Str::singular($config['table']))}}()
        {
            return $this->hasOne({{\Cubetiq\Litegen\Support\Helper::studly_singular($config['table'])}}::class,'{{$config['foreign']}}');
        }
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\RelationshipType::BELONGS_TO)

        public function {{\Illuminate\Support\Str::studly(\Illuminate\Support\Str::singular($config['table']))}}()
        {
            return $this->BelongsTo({{\Cubetiq\Litegen\Support\Helper::studly_singular($config['table'])}}::class,'{{$config['foreign']}}');
        }
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\RelationshipType::BELONGSTOMANY)

        public function {{\Illuminate\Support\Str::studly(\Illuminate\Support\Str::plural($config['table']))}}()
        {
            return $this->BelongsToMany({{\Cubetiq\Litegen\Support\Helper::studly_singular($config['table'])}}::class,'{{$config['through']['table']}}','{{$config['through']['foreign_from']}}','{{$config['through']['foreign_to'],"id","id"}}');
        }
        @endif

    @endforeach

}
