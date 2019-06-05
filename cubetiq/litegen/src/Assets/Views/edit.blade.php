{!!"@"."extends('layouts.app')"!!}

{!!"@"."section('content')"!!}

<h1>
    Edit    {!!\Illuminate\Support\Str::studly($class)!!} @{!! $item->id !!}
</h1>


{!!"@"."php"!!}

dd($item);

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
