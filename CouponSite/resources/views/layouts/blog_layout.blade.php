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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"
          integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    @show
</head>
<body>
    <div class="body-content">
        <!--header content-->
        @section('blog-header')
            @include('layouts.blog_header')
        @show
        <!--body content-->
        <div class="blog-main-container">
            <div class="blog-wrapper-area-container">
                <div class="blog-container">
                @yield('content')
                </div>
                <div class="blog-sidebar-container">
                    <div class="blog-sb-content-container">
                        <div class="blog-sb-content-heading">Popular Stores</div>
                        <div class="blog-sb-content-details">
                            @foreach($topstores as $store)
                            <a class="blog-sb-content-img" href="/store/{{$store->secondary_url}}" title="{{$store->title}} Coupons">
                                <img src="{{$panel_assets_url.$store->logo_url}}">
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="blog-sb-content-container">
                        <div class="blog-sb-content-heading">Popular Categories</div>
                        <div class="blog-sb-content-details">
                            @foreach($topcategories as $category)
                            <a class="blog-sb-content-img" href="/coupons/{{$category->url}}" title="{{$category->title}} Coupons">
                                <img src="{{$panel_assets_url.$category->logo_url}}">
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
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