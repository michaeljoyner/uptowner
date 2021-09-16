<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
    @section('title')
        <title>Uptowner | Admin</title>
    @show
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    @yield('head')
    {{--<script>--}}
        {{--var Laravel = {--}}
            {{--csrfToken: '{{ csrf_token() }}'--}}
        {{--}--}}
    {{--</script>--}}
    <script defer src="https://unpkg.com/alpinejs@3.3.2/dist/cdn.min.js"></script>
</head>
<body>
@if(Auth::check())
    @include('admin.partials.navbar')
@else
    @include('admin.partials.fakenavbar')
@endif
<div class="container" id="app">
    @yield('content')
</div>
{{--<div class="main-footer"></div>--}}
<script src="{{ mix('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
@include('admin.partials.flash')
@yield('bodyscripts')
</body>
</html>