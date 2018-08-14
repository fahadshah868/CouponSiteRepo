@extends('layouts.app_layout')

@section('title','Home Page')

@section('content')

  <div class="slider" id="slider">
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
  
  <div class="body-main-content">
    <div class="today-deals-main-content">
      <div class="today-deals-heading">
        <font>Today's Hot Deals</font>
      </div>
      <div class="today-deals-products-content">
          <div class="today-deals-product">
            <img src="https://i2.wp.com/www.deanesofcheddar.co.uk/wp-content/uploads/2016/06/deane_and_Sons-formal_hire-350x300.jpg" />
            <div class="today-deals-product-description-content">
              <div class="today-deals-product-description-brandlogo-content">
                <img class="today-deals-product-description-brandlogo" src="https://i.pinimg.com/236x/e2/78/b5/e278b50089cdb17419256e4b2b99fd49--gymboree-promenade.jpg" />
              </div>
              <div class="today-deals-product-detail">
                <font class="today-deals-product-offer">Up to 40% Off</font>
                <br>
                <font class="today-deals-product-brand">Pacsun Sale</font>
              </div>
            </div>
          </div>
          <div class="today-deals-product">
            <img src="http://www.thedorchester.com.au/site/wp-content/uploads/2016/05/family-hols-350x300.jpg" />
            <div class="today-deals-product-description-content">
              <div class="today-deals-product-description-brandlogo-content">
                  <img class="today-deals-product-description-brandlogo" src="https://i.pinimg.com/236x/e2/78/b5/e278b50089cdb17419256e4b2b99fd49--gymboree-promenade.jpg"/>
                </div>
                <div class="today-deals-product-detail">
                  <font class="today-deals-product-offer">Up to 40% Off</font>
                  <br>
                  <font class="today-deals-product-brand">Pacsun Sale</font>
                </div>
              </div>
          </div>
          <div class="today-deals-product">
            <img style="cursor:pointer;" src="https://www.centrasota.com/CTRA/media/Images/design/Country-Store-350-x-300.jpg?ext=.jpg" />
            <div class="today-deals-product-description-content">
                <div class="today-deals-product-description-brandlogo-content">
                  <img class="today-deals-product-description-brandlogo" src="https://i.pinimg.com/236x/e2/78/b5/e278b50089cdb17419256e4b2b99fd49--gymboree-promenade.jpg" />
                </div>
                <div class="today-deals-product-detail">
                  <font class="today-deals-product-offer">Up to 40% Off</font>
                  <br>
                  <font class="today-deals-product-brand">Pacsun Sale</font>
                </div>
              </div>
          </div>
      </div>
    </div>
    <div class="top-offers-main-content">
      <div class="top-offers-heading">
        <font>Top Offers</font>
      </div>
      <div class="top-offers-products">
        @for($i=1; $i<=8; $i++)
        <div class="top-offers-product">
          <div class="top-offer-product-img" style="margin:10px auto 0 auto; width:150px; height:150px;">
            <img src="https://i.pinimg.com/236x/bd/24/af/bd24afe038f5767224797820cff74caa.jpg" style="width:100%; height:100%;"/>
          </div>
          <div class="top-offer-product-title" style="width:240px; height: 55px; margin: 10px auto 0 auto; text-align:center;">
            <font style="font-size:18px; font-weight:bold;">Famous Product title</font>
          </div>
          <hr style="border-top: 1px dotted #D5D1D1;">
          <div class="top-offer-product-detail" style="text-align:center; margin:0 20px 0 20px;">
            <font class="top-offer-product-offer" style="font-size:18px; font-weight:bold; color:#F45336;">
              Up to 30% Off
            </font>
            <br>
            <font class="top-offer-product-offer-type" style="font-size:16px; font-weight:bold; color:grey;">
              sale
            </font>
          </div>
          <div class="top-offer-product-button" style="text-align:center; margin: 10px 20px 0 20px;">
            <button id="product-button" style="width:100%; height: 35px; background-color:#F45336; color: #ffffff; border: 1px solid #F45336; border-radius: 4px; font-weight:bold; cursor:pointer; transition: 0.5s;">VIEW CODE</button>
          </div>
        </div>
        @endfor
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {  
      $("#slider").sliderResponsive({
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