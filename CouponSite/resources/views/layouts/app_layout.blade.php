<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!--stylesheet section-->
    @section('stylesheet')
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    @show
</head>
<body>
    <div class="body-content">
        <!--header content-->
        @section('app-header')
            @include('layouts.app_header')
        @show
        <!--body content-->
        <div>
            @yield('content')
            <!--offer modal-->
        </div>
        <!--footer content-->
        @section('app-footer')
            @include('layouts.app_footer')
        @show
        <!--jquery content-->
        <script src="{{asset('js/app.js')}}"></script>
        @yield('js-section')
    </div>
</body>
</html>