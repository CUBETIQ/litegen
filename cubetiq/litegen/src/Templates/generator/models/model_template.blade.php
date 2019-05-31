namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class {{\Illuminate\Support\Str::studly($class)}} extends Model
{
@php

@endphp
    //
    protected $table="{{\Illuminate\Support\Str::snake($class)}}";

    protected $fillable=[{!!  sizeof(array_keys($columns))?"\"".implode("\",\"",array_keys($columns))."\"":"" !!}];

    @foreach($relationships as $column_name=>$config)

    public function {{\Illuminate\Support\Str::studly($config['table'])}}()
    {
        @if($config['type']==\Cubetiq\Litegen\Definitions\ModelType::HAS_MANY)

        return $this->hasMany({{\Illuminate\Support\Str::studly($config['table'])}}::class,'{{$config['column']}}');
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\ModelType::HAS_ONE)

        return $this->hasOne({{\Illuminate\Support\Str::studly($config['table'])}}::class,'{{$config['column']}}');
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\ModelType::BELONGS_TO)

        return $this->BelongsTo({{\Illuminate\Support\Str::studly($config['table'])}}::class,'{{$config['column']}}');
        @endif

    }

    @endforeach

}
