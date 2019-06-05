@php
    $name=\Illuminate\Support\Str::studly($class);
    $class=\Illuminate\Support\Str::singular(\Illuminate\Support\Str::lower($name));
    $Class=\Illuminate\Support\Str::singular(\Illuminate\Support\Str::ucfirst($name));
    $classes=\Illuminate\Support\Str::plural($class);
    $Classes=\Illuminate\Support\Str::plural($class);

    $model_types=\Cubetiq\Litegen\Definitions\ModelType::getConstants();
@endphp

{!!"@"."extends('layouts.app')"!!}

{!!"@"."section('content')"!!}
<h1>
    List All {!!$Classes!!}
</h1>

{!!"@"."php"!!}


{!!"@"."endphp"!!}


<table border="1">
    <thead>

    @foreach(array_keys($model) as $column)

        <th>{{\Illuminate\Support\Str::studly($column)}}</th>
    @endforeach

    </thead>

    {{"@".'foreach($'.$classes.' as $item)'}}

    <tr>
        @foreach(array_keys($model) as $column)
            @if(in_array($model[$column]['type'],$model_types))

        <th>{{"{{".'$item'}}['{{$column}}']}}</th>
            @elseif($model[$column]['type']==\Cubetiq\Litegen\Definitions\RelationshipType::BELONGS_TO)

        <th>{{"{{".'$item'}}['{{$column}}']['name']}}</th>
            @else

        <th>{{"{{".'json_encode($item'}}['{{\Illuminate\Support\Str::studly(\Illuminate\Support\Str::lower($model[$column]['table']))}}'])}}</th>
            @endif
        @endforeach

    </tr>
    {{'@'."endforeach"}}
</table>


{!!"@"."stop"!!}


{!!"@"."section('css')"!!}
<style>


</style>
{!!"@"."stop"!!}

{!!"@"."section('script')"!!}

<script>

</script>
{!!"@"."stop"!!}
