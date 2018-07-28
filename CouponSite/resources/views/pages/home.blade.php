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
      <br><br>
      <div class="today-deals-main-content">
        <div class="today-deals-heading">
          <font>Today's Hot Deals</font>
        </div>
        <div class="today-deals-products-content">
            <div class="today-deals-product">
              <img src="https://i2.wp.com/www.deanesofcheddar.co.uk/wp-content/uploads/2016/06/deane_and_Sons-formal_hire-350x300.jpg" />
              <div class="today-deals-product-description">
                <div class="today-deals-product-description-brandlogo-content">
                  <img class="today-deals-product-description-brandlogo" src="https://www.spellbrand.com/images/blog/images/PacSun-teen-clothing-logo-design.jpg" />
                </div>
                <div>
                  <h6>Upto 40% Off</h6>
                  <p>Pacsun Sale</p>
                </div>
              </div>
            </div>
            <div class="today-deals-product">
              <img src="http://www.thedorchester.com.au/site/wp-content/uploads/2016/05/family-hols-350x300.jpg" />
              <div class="today-deals-product-description">
                <div class="today-deals-product-description-brandlogo-content">
                    <img class="today-deals-product-description-brandlogo" src="https://www.spellbrand.com/images/blog/images/PacSun-teen-clothing-logo-design.jpg" />
                  </div>
                  <div>
                    <h6>Upto 40% Off</h6>
                    <p>Pacsun Sale</p>
                  </div>
                </div>
            </div>
            <div class="today-deals-product">
              <img style="cursor:pointer;" src="https://www.centrasota.com/CTRA/media/Images/design/Country-Store-350-x-300.jpg?ext=.jpg" />
              <div class="today-deals-product-description">
                  <div class="today-deals-product-description-brandlogo-content">
                    <img class="today-deals-product-description-brandlogo" src="https://www.spellbrand.com/images/blog/images/PacSun-teen-clothing-logo-design.jpg" />
                  </div>
                  <div>
                    <h6>Upto 40% Off</h6>
                    <p>Pacsun Sale</p>
                  </div>
                </div>
            </div>
        </div>
      </div>
      <div class="top-offers-main-content">
        <div class="top-offers-heading">
          <font><b>Top Offers</b></font>
        </div>
        <div class="top-offers-products">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
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