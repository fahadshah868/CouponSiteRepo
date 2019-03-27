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
    <div class="top-stores-heading">Top Stores</div>
    <!--Stores Slides-->
    <div class="stores-container">
      @foreach($topstores as $topstore)
      <div class="item">
          <div class="store-img">
            <a href="/store/{{$topstore->secondary_url}}"><img src="{{$panel_assets_url.$topstore->logo_url}}" ></a>
          </div>
      </div>
      @endforeach
    </div>
    <!--Arrows-->
    <div class="MS-controls">
      <button type="button" class="MS-left"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></button>
      <button type="button" class="MS-right"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
    </div>
  </div>
  
  <!-- Top Offers Deals Products--------------------------------------------------------------------------------- -->
  <div class="home-offers-main-container">
    <!--Heading-->
    <div class="home-offers-heading">Top Offers, Deals & Coupon Codes</div>
    <!--Products-->
    <div class="home-offers-container">
      @foreach($offers as $offer)
      <div class="home-offer-container">
        <div class="home-offer-store-logo">
          <a href="/store/{{$offer->store->secondary_url}}" title="{{$offer->store->title}}">
            <img src="{{$panel_assets_url.$offer->store->logo_url}}"/>
          </a>
        </div>
        <hr style="border-top: 1px dotted #d1d1d1; width: 100%;">
        <div class="home-offer-offertitle">
          {{$offer->title}}
        </div>
        <span class="home-offer-offertype-code">{{$offer->location}} {{$offer->type}}</span>
        <span class="home-offer-button" id="home-offer-button" data-offertitle="20% Off One Select Regular-Priced Item" data-offercode="ZSTG45H" data-offerexpires="10/12/2018" data-storesitelink="https://www.dominos.com">VIEW CODE</span>
      </div>
      @endforeach
    </div>
    <span class="home-loadmore-button">Load More</span>
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