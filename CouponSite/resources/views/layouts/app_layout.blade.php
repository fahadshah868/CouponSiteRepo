<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!--stylesheet section-->
    @section('stylesheet')
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"
          integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    @show
    @section('javascript')
        <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"></script>
        <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('js/imageslider.js')}}"></script>
        <script src="{{asset('js/topstoresms.min.js')}}"></script>
        <script src="{{asset('js/header.js')}}"></script>
    @show
</head>
<body>
    <div class="body-content">
        <!--header content-->
        @section('app-header')
            @include('layouts.header')
        @show
        <!--body content-->
        <div>
            @yield('content')
        </div>
        <!--footer content-->
        @section('app-footer')
            @include('layouts.footer')
        @show
    </div>
</body>
</html>