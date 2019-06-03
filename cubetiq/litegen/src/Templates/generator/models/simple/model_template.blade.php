namespace App\Models;

use Illuminate\Database\Eloquent\Model;
@php
$table_format_name=\Cubetiq\Litegen\Support\Helper::db_tname_format($class);
        @endphp

class {{\Cubetiq\Litegen\Support\Helper::studly_singular($class)}} extends Model
{

    //
    protected $table="{{\Illuminate\Support\Str::snake($table_format_name)}}";

    protected $fillable=[{!!  sizeof(array_keys($columns))?"\"".implode("\",\"",array_keys($columns))."\"":"" !!}];

    @foreach($relationships as $column_name=>$config)

    public function {{\Illuminate\Support\Str::studly($config['table'])}}()
    {
        @if($config['type']==\Cubetiq\Litegen\Definitions\ModelType::HAS_MANY)

        return $this->hasMany({{\Cubetiq\Litegen\Support\Helper::studly_singular($config['table'])}}::class,'{{$config['column']}}');
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\ModelType::HAS_ONE)

        return $this->hasOne({{\Cubetiq\Litegen\Support\Helper::studly_singular($config['table'])}}::class,'{{$config['column']}}');
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\ModelType::BELONGS_TO)

        return $this->BelongsTo({{\Cubetiq\Litegen\Support\Helper::studly_singular($config['table'])}}::class,'{{$config['column']}}');
        @endif

    }

    @endforeach

}
