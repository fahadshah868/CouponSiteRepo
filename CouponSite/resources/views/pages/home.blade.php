@extends('layouts.app_layout')

@section('title','Home Page')

@section('content')

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
  <div class="today-hot-deals-main-container">
    <!--Heading-->
    <div class="today-hot-deals-heading">Today's Hot Deals</div>
    <!--Products-->
    <div class="today-hot-deals-container">
      <div class="today-hot-deals">
          <!--Product (1)-->
          <div class="today-hot-deal">
            <a href="#" class="today-hot-deal-link">
              <img class="today-hot-deal-img" src="https://i2.wp.com/www.deanesofcheddar.co.uk/wp-content/uploads/2016/06/deane_and_Sons-formal_hire-350x300.jpg" />
              <div class="today-hot-deal-description-container">
                <div class="today-hot-deal-description-brandlogo-container">
                  <img class="today-hot-deal-description-brandlogo" src="https://i.pinimg.com/236x/e2/78/b5/e278b50089cdb17419256e4b2b99fd49--gymboree-promenade.jpg" />
                </div>
                <div class="today-hot-deal-detail">
                  <div class="today-hot-deal-offer">Up to 40% Off</div>
                  <p class="today-hot-deal-brand">Pacsun Sale</p>
                </div>
              </div>
            </a>
          </div>
          <!--Product (2)-->
          <div class="today-hot-deal">
            <a href="#" class="today-hot-deal-link">
              <img class="today-hot-deal-img" src="http://www.thedorchester.com.au/site/wp-content/uploads/2016/05/family-hols-350x300.jpg" />
              <div class="today-hot-deal-description-container">
                <div class="today-hot-deal-description-brandlogo-container">
                  <img class="today-hot-deal-description-brandlogo" src="https://i.pinimg.com/236x/e2/78/b5/e278b50089cdb17419256e4b2b99fd49--gymboree-promenade.jpg"/>
                </div>
                <div class="today-hot-deal-detail">
                  <div class="today-hot-deal-offer">Up to 40% Off</div>
                  <p class="today-hot-deal-brand">Pacsun Sale</p>
                </div>
              </div>
            </a>
          </div>
          <!--Product (3)-->
          <div class="today-hot-deal">
            <a href="#" class="today-hot-deal-link">
              <img class="today-hot-deal-img" style="cursor:pointer;" src="https://www.centrasota.com/CTRA/media/Images/design/Country-Store-350-x-300.jpg?ext=.jpg" />
              <div class="today-hot-deal-description-container">
                <div class="today-hot-deal-description-brandlogo-container">
                  <img class="today-hot-deal-description-brandlogo" src="https://i.pinimg.com/236x/e2/78/b5/e278b50089cdb17419256e4b2b99fd49--gymboree-promenade.jpg" />
                </div>
                <div class="today-hot-deal-detail">
                  <div class="today-hot-deal-offer">Up to 40% Off</div>
                  <p class="today-hot-deal-brand">Pacsun Sale</p>
                </div>
              </div>
            </a>
          </div>
      </div>
    </div>
  </div>

  <!--Top Stores-------------------------------------------------------------------------------------------------->
  <div class="top-stores-main-container" id="top-stores-main-container">
    <!--Heading-->
    <div class="top-stores-heading">Top Featured Stores</div>
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
    <div class="top-offers-heading">Top Offers, Deals & Coupon Codes</div>
    <!--Products-->
    <div class="top-offers-container">
      @for($i=1; $i<=12; $i++)
      <div class="top-offer-container">
        <a class="top-offer-link modal-offer-link" id="offer-link" data-offertitle="20% Off One Select Regular-Priced Item" data-offercode="ZSTG45H" data-offerexpires="10/12/2018" data-storesitelink="https://www.dominos.com" href="#">
          <div class="top-offer-store-logo">
            <img src="https://pbs.twimg.com/profile_images/976862446131580928/mN8gwNRi_400x400.jpg"/>
          </div>
          <hr style="border-top: 1px dotted #d1d1d1; width: 100%;">
          <div class="top-offer-offertitle">
            20% Off One Select Regular-Priced Item
          </div>
          <div class="top-offer-offertype-code">Code</div>
          <button type="button" id="top-offer-button">VIEW CODE</button>
        </a>
      </div>
      @endfor
    </div>
  </div>
  <!--top instore coupons-->
  <div class="top-instore-offers-main-container">
    <!--Heading-->
    <div class="top-instore-offers-heading">Best In-Store Coupon Codes</div>
    <!--Products-->
    <div class="top-instore-offers-container">
      @for($i=1; $i<=8; $i++)
      <div class="top-instore-offer-container">
        <a class="top-instore-offer-link modal-offer-link" href="#">
          <div class="top-instore-offer-store-logo">
            <img src="https://pbs.twimg.com/profile_images/976862446131580928/mN8gwNRi_400x400.jpg"/>
          </div>
          <hr style="border-top: 1px dotted #d1d1d1; width: 100%;">
          <div class="top-instore-offer-offertitle">
            Up to 30%
          </div>
          <div class="top-instore-offer-offertype-instorecoupon">
            In-Store coupon
          </div>
          <button type="button" id="top-instore-offer-button">VIEW CODE</button>
        </a>
      </div>
      @endfor
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