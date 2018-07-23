@extends('layouts.app_layout')

@section('content')
<div class="slider" id="slider1">
        <!-- Slides -->
        <div style="background-image:url(https://unsplash.it/1920/1200?image=839)"></div>
        <div style="background-image:url(https://unsplash.it/1920/1200?image=838)"></div>
        <div style="background-image:url(https://unsplash.it/1920/1200?image=836)"></div>
        <div style="background-image:url(https://unsplash.it/1920/1200?image=826)"></div>
        <div style="background-image:url(https://unsplash.it/1920/1200?image=822)"></div>
        <!-- The Arrows -->
        <i class="left" class="arrows" style="z-index:2; position:absolute;"><svg viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z"></path></svg></i>
        <i class="right" class="arrows" style="z-index:2; position:absolute;"><svg viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" transform="translate(100, 100) rotate(180) "></path></svg></i>
    </div>
    
    <br>
    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="{{asset('js/imageslider.js')}}"></script>
    <script>
    $(document).ready(function() {  
      $("#slider1").sliderResponsive({
      // Using default everything
        // slidePause: 5000,
        // fadeSpeed: 800,
        // autoPlay: "on",
        // showArrows: "off", 
        // hideDots: "off", 
        // hoverZoom: "on", 
        // titleBarTop: "off"
      });  
    }); 
    </script>
@endsection