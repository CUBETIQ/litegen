@php
    $name=\Illuminate\Support\Str::studly($class);
    $class=\Illuminate\Support\Str::singular(\Illuminate\Support\Str::lower($name));
    $Class=\Illuminate\Support\Str::singular(\Illuminate\Support\Str::ucfirst($name));
    $classes=\Illuminate\Support\Str::plural($class);
    $Classes=\Illuminate\Support\Str::plural($class);
@endphp

{!!"@"."extends('layouts.app')"!!}

{!!"@"."section('content')"!!}
<h1>
    List All {!!$Classes!!}
</h1>

{!!"@"."php"!!}

dd(${!!$classes!!});

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
