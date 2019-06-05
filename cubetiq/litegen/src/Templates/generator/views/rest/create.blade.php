
{!!"@"."extends('layouts.app')"!!}

{!!"@"."section('content')"!!}

<h1>
    Create   {!!\Illuminate\Support\Str::studly($class)!!}
</h1>

{!!"@"."php"!!}
@foreach($relates as $relate)

    ${{\Illuminate\Support\Str::snake($relate)}}=${{\Illuminate\Support\Str::snake($relate)}};
@endforeach


{!!"@"."endphp"!!}




{!!"@"."stop"!!}


{!!"@"."section('css')"!!}
<style>


</style>
{!!"@"."stop"!!}

{!!"@"."section('script')"!!}

<script>

</script>
{!!"@"."stop"!!}
