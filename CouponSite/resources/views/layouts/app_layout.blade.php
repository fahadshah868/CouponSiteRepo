<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coupon Site</title>
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/home.css')}}"/>
</head>
<body>
    <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"></script>
    <div class="main-content">
        <!--header content-->
        <div>
            @include('layouts.header')
        </div>
        <!--body content-->
        <div>
            @yield('content')
        </div>
        <!--footer content-->
        <div>
            @include('layouts.footer')
        </div>
    </div>
</body>
</html>