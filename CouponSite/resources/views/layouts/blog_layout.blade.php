<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    
    <meta property="og:title" content="@yield('sharetitle')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:url" content="@yield('pageurl')">
    <meta property="og:image" content="@yield('imageurl')">
    <meta property="og:image:secure_url" content="@yield('imageurl')">
    <meta property="og:image:width" content="900"/>
    <meta property="og:image:height" content="600"/>

    <meta name="twitter:title" content="@yield('sharetitle')">
    <meta name="twitter:description" content="@yield('description')">
    <meta name="twitter:image" content="@yield('imageurl')">
    <meta name="twitter:card" content="summary_large_image">

    
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
            <div class="blog-wrapper-container" id="blog-wrapper-container">
                <div class="blog-frame-container">
                @yield('content')
                </div>
                <div class="blog-sidebar-outer-container">
                    <div class="blog-sidebar-inner-container" id="blog-sidebar-inner-container">
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
        </div>
        <!--footer content-->
        @section('app-footer')
            @include('layouts.app_footer')
        @show
        <!--jquery content-->
        <script src="{{asset('js/app.js')}}"></script>
        <script>
            $(document).ready(function(){
                var blog_container_height = $("#blog-sidebar-inner-container").height();
                var height_difference = $(this).scrollTop() - $('#blog-wrapper-container').position().top;
                if(height_difference >= 0 && height_difference + blog_container_height < $(`#blog-wrapper-container`).height()){
                    $(`#blog-sidebar-inner-container`).css({position: `fixed`, top: `10px`, bottom: `auto`, width: `330px`});
                }
                else if(height_difference + blog_container_height >= $(`#blog-wrapper-container`).height()){
                    $(`#blog-sidebar-inner-container`).css({position: `absolute`, top: `auto`, bottom: `0`, width: `330px`});
                }
                else{
                    $(`#blog-sidebar-inner-container`).css({position: `absolute`, top: `0`, bottom: `auto`, width: `100%`});
                }
                $(document).on('scroll', function() {
                    height_difference = $(this).scrollTop() - $('#blog-wrapper-container').position().top;
                    if(height_difference >= 0 && height_difference + blog_container_height < $(`#blog-wrapper-container`).height()){
                        $(`#blog-sidebar-inner-container`).css({position: `fixed`, top: `10px`, bottom: `auto`, width: `330px`});
                    }
                    else if(height_difference + blog_container_height >= $(`#blog-wrapper-container`).height()){
                        $(`#blog-sidebar-inner-container`).css({position: `absolute`, top: `auto`, bottom: `0`, width: `330px`});
                    }
                    else{
                        $(`#blog-sidebar-inner-container`).css({position: `absolute`, top: `0`, bottom: `auto`, width: `100%`});
                    }
                });
            });
        </script>
        @yield('js-section')
    </div>
</body>
</html>