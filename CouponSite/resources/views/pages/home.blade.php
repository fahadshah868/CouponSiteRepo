@extends('layouts.app_layout')

@section('title','Home Page')

@section('content')

<div class="body-main-container">

    <div class="cover-img" ></div>
  <!--Main Image Slider---------------------------------------------------------------------------------------------->
  {{-- <div class="slider" id="slider">
    <!--Slides-->
    <div style="background-image:url(https://unsplash.it/1920/1200?image=839)"></div>
    <div style="background-image:url(https://unsplash.it/1920/1200?image=838)"></div>
    <div style="background-image:url(https://unsplash.it/1920/1200?image=836)"></div>
    <div style="background-image:url(https://unsplash.it/1920/1200?image=826)"></div>
    <div style="background-image:url(https://unsplash.it/1920/1200?image=822)"></div>
    <!--The Arrows-->
    <i class="left" class="arrows" style="z-index:2; position:absolute;"><svg viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z"></path></svg></i>
    <i class="right" class="arrows" style="z-index:2; position:absolute;"><svg viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" transform="translate(100, 100) rotate(180) "></path></svg></i>
  </div> --}}

  <!--Todays New Hot Deals---------------------------------------------------------------------------------------->
  <div class="today-deals-main-container">
    <!--Heading-->
    <div class="today-deals-heading">
      <h2>Today's Hot Deals</h2>
    </div>
    <!--Products-->
    <div class="today-deals-products-container">
        <!--Product (1)-->
        <div class="today-deals-product">
          <img src="https://i2.wp.com/www.deanesofcheddar.co.uk/wp-content/uploads/2016/06/deane_and_Sons-formal_hire-350x300.jpg" />
          <div class="today-deals-product-description-container">
            <div class="today-deals-product-description-brandlogo-container">
              <img class="today-deals-product-description-brandlogo" src="https://i.pinimg.com/236x/e2/78/b5/e278b50089cdb17419256e4b2b99fd49--gymboree-promenade.jpg" />
            </div>
            <div class="today-deals-product-detail">
              <h2 class="today-deals-product-offer">Up to 40% Off</h2>
              <p class="today-deals-product-brand">Pacsun Sale</p>
            </div>
          </div>
        </div>
        <!--Product (2)-->
        <div class="today-deals-product">
          <img src="http://www.thedorchester.com.au/site/wp-content/uploads/2016/05/family-hols-350x300.jpg" />
          <div class="today-deals-product-description-container">
            <div class="today-deals-product-description-brandlogo-container">
              <img class="today-deals-product-description-brandlogo" src="https://i.pinimg.com/236x/e2/78/b5/e278b50089cdb17419256e4b2b99fd49--gymboree-promenade.jpg"/>
            </div>
            <div class="today-deals-product-detail">
              <h2 class="today-deals-product-offer">Up to 40% Off</h2>
              <p class="today-deals-product-brand">Pacsun Sale</p>
            </div>
          </div>
        </div>
        <!--Product (3)-->
        <div class="today-deals-product">
          <img style="cursor:pointer;" src="https://www.centrasota.com/CTRA/media/Images/design/Country-Store-350-x-300.jpg?ext=.jpg" />
          <div class="today-deals-product-description-container">
              <div class="today-deals-product-description-brandlogo-container">
                <img class="today-deals-product-description-brandlogo" src="https://i.pinimg.com/236x/e2/78/b5/e278b50089cdb17419256e4b2b99fd49--gymboree-promenade.jpg" />
              </div>
              <div class="today-deals-product-detail">
                <h2 class="today-deals-product-offer">Up to 40% Off</h2>
                <p class="today-deals-product-brand">Pacsun Sale</p>
              </div>
            </div>
        </div>
    </div>
  </div>


  <!--Top Stores-------------------------------------------------------------------------------------------------->
  <div class="top-stores-main-container" id="top-stores-main-container">
    <!--Heading-->
    <div class="top-stores-heading">
      <h2>Top Stores</h2>
    </div>
    <!--Stores Slides-->
    <div class="stores-container">
      @for($i=1; $i<=10; $i++)
      <div class="item">
          <div class="store-img">
              <img src="https://igx.4sqi.net/img/general/200x200/38757329_V6X_cPjnJ2QsS2w-P7Ret6Lfm8T7J-i4dMRtGBbf-B4.jpg" >
          </div>
      </div>
      @endfor
    </div>
    <!--Arrows-->
    <div class="MS-controls">
      <button type="button" class="MS-left"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></button>
      <button type="button" class="MS-right"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
    </div>
</div>

  
  <!--Top Offers Deals Products----------------------------------------------------------------------------------->
  <div class="top-offers-main-container">
    <!--Heading-->
    <div class="top-offers-heading">
      <h2>Top Offers</h2>
    </div>
    <!--Products-->
    <div class="top-offers-products">
      @for($i=1; $i<=8; $i++)
        <div class="top-offers-product">
          <div class="top-offer-product-img">
            <img src="https://i.pinimg.com/236x/bd/24/af/bd24afe038f5767224797820cff74caa.jpg"/>
          </div>
          <div class="top-offer-product-title">
            <h2>Famous Product title</h2>
          </div>
          <hr style="border-top: 1px dotted #D5D1D1; margin-top: 2px;">
          <div class="top-offer-product-detail">
            <h2 class="top-offer-product-offer">
              Up to 30% Off
            </h2>
            <p class="top-offer-product-offer-type">
              sale
            </p>
          </div>
          <div class="top-offer-product-button">
            <button type="button" id="product-button">VIEW CODE</button>
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
    $('#top-stores-main-container').multislider({
        interval: 5000,
        slideAll: false,
        duration: 700
    }); 
  </script>
@endsection