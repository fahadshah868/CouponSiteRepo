@extends('layouts.app_layout')

@section('title','Home Page')

@section('content')

<!-- carousel slider ---------------------------------------------------------->
@if(count($carouseloffers) > 0)
<div class="carousel-container">
  <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      @for($i=0; $i< count($carouseloffers); $i++) @if($i==0) <li data-target="#carouselIndicators" data-slide-to="{{$i}}" class="active">
        </li>
        @else
        <li data-target="#carouselIndicators" data-slide-to="{{$i}}"></li>
        @endif
        @endfor
    </ol>
    <div class="carousel-inner">
      @foreach($carouseloffers as $index=>$carouseloffer)
      @if($index == 0)
      <div class="carousel-item active">
        <a href="{{$carouseloffer->store->network_url}}" target="_blank">
          <div class="carousel-material-container">
            <img class="carousel-img" src="{{$panel_assets_url.$carouseloffer->image_url}}">
            <div class="carousel-offer-container">
              <img class="carousel-store-logo" src="{{$panel_assets_url.$carouseloffer->store->logo_url}}">
              <h5>{{$carouseloffer->title}}</h5>
              <span class="btn">{{$carouseloffer->store->title.' '.$carouseloffer->location.' '.$carouseloffer->type}}</span>
            </div>
          </div>
        </a>
      </div>
      @else
      <div class="carousel-item">
        <a href="{{$carouseloffer->store->network_url}}" target="_blank">
          <div class="carousel-material-container">
            <img class="carousel-img" src="{{$panel_assets_url.$carouseloffer->image_url}}">
            <div class="carousel-offer-container">
              <img class="carousel-store-logo" src="{{$panel_assets_url.$carouseloffer->store->logo_url}}">
              <h5>{{$carouseloffer->title}}</h5>
              <span class="btn">{{$carouseloffer->store->title.' '.$carouseloffer->location.' '.$carouseloffer->type}}</span>
            </div>
          </div>
        </a>
      </div>
      @endif
      @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
      <span class="carousel-control-icon"><i class="fa fa-angle-double-left"></i></span>
    </a>
    <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
      <span class="carousel-control-icon"><i class="fa fa-angle-double-right"></i></span>
    </a>
  </div>
</div>
@endif
<!--Top Stores------------------------------------------------------------------>
<div class="hm-ts-main-container" id="hm-ts-main-container">
  <!--Heading-->
  <div class="hm-ts-heading">Top Stores</div>
  <!--Stores Slides-->
  <div class="hm-ts-container">
    @foreach($topstores as $topstore)
    <div class="item">
      <div class="store-img">
        <a href="/store/{{$topstore->secondary_url}}"><img src="{{$panel_assets_url.$topstore->logo_url}}"></a>
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
<!-- Top Offers Deals Products-------------------------------------------------------->
<div class="hm-offers-main-container">
  <!--Heading-->
  <div class="hm-offers-heading">Today's Offers, Deals & Coupon Codes</div>
  <!--Products-->
  <div class="hm-offers-container js-offer" id="hm-offers-container">
    @foreach($offers as $offer)
    <div class="hm-offer-container">
      <div class="hm-offer-store-logo">
        <a href="/store/{{$offer->store->secondary_url}}" title="{{$offer->store->title}}">
          <img src="{{$panel_assets_url.$offer->store->logo_url}}" />
        </a>
      </div>
      <hr style="border-top: 1px dotted #d1d1d1; width: 100%;">
      <div class="hm-offer-offertitle">
        {{$offer->title}}
      </div>
      <div class="hm-offer-type">
        <span class="hm-offer-offertype-code">{{$offer->location}} {{$offer->type}}</span>
      </div>
      <span class="hm-offer-button js-offer-button" data-offerid="{{$offer->id}}" data-offertitle="{{$offer->title}}" data-offerlocation="{{$offer->location}}" data-offertype="{{$offer->type}}" data-offerdetails="{{$offer->details}}" data-offercode="{{$offer->code}}" data-storetitle="{{$offer->store->title}}" data-storelogo="{{$panel_assets_url.$offer->store->logo_url}}" data-siteurl="{{$offer->store->secondary_url}}" data-offerexpiry="{{$offer->expiry_date}}" data-navurl="{{$offer->store->network_url}}">
        @if(strcasecmp($offer->type,"code") == 0)
        VIEW CODE
        @else
        GET DEAL
        @endif
      </span>
    </div>
    @endforeach
  </div>
  @if($offers->hasMorePages())
  <button class="loadmore-button" id="loadmore-button"><img class="loading-circle" id="loading-circle" src="{{asset('/images/loading-circle.gif')}}">Load More</button>
  @endif
</div>
<!--popular stores container-------------------------------------------------------->
<div class="hm-popular-stores-main-container">
  <!--Heading-->
  <div class="hm-popular-stores-heading">Popular Stores</div>
  <div class="hm-popular-stores-container">
    @foreach($popularstores as $popularstore)
    <a href="/store/{{$popularstore->secondary_url}}" class="hm-popular-store-container" title="{{$popularstore->title}}">
      <span class="store-title">{{$popularstore->title}}</span>
      @if($popularstore->offers_count > 1)
      <span class="coupons-count">{{$popularstore->offers_count}} Coupons Available</span>
      @elseif($popularstore->offers_count == 1)
      <span class="coupons-count">{{$popularstore->offers_count}} Coupon Available</span>
      @else
      <span class="coupons-count">No Coupons Available</span>
      @endif
    </a>
    @endforeach
  </div>
</div>
<!--popular categories container---------------------------------------------------->
<div class="hm-popular-categories-main-container">
  <!--Heading-->
  <div class="hm-popular-categories-heading">Popular Categories</div>
  <div class="hm-popular-categories-container">
    @foreach($popularcategories as $popularcategory)
    <a href="/category/{{$popularcategory->url}}" class="hm-popular-category-container" title="{{$popularcategory->title}}">
      <span class="category-title">{{$popularcategory->title}}</span>
      @if($popularcategory->offers_count > 1)
      <span class="coupons-count">{{$popularcategory->offers_count}} Coupons Available</span>
      @elseif($popularcategory->offers_count == 1)
      <span class="coupons-count">{{$popularcategory->offers_count}} Coupon Available</span>
      @else
      <span class="coupons-count">No Coupons Available</span>
      @endif
    </a>
    @endforeach
  </div>
</div>
<!--blogs container----------------------------------------------------------------->
<div class="hm-blog-main-container">
  <!--Heading-->
  <div class="hm-blogs-heading">Latest Blogs</div>
  <!--blogs-->
  <div class="hm-blogs-container">
    @foreach($latestblogs as $latestblog)
    <div class="hm-blog-container">
      <div class="blog-image">
        <a class="blog-link" href="/blog/{{$latestblog->url}}">
          <img src="{{$panel_assets_url.$latestblog->image_url}}">
        </a>
      </div>
      <div class="blog-title"><a href="/blog/{{$latestblog->url}}">{{$latestblog->title}}</a></div>
      <div class="readnow-link">[<a href="/blog/{{$latestblog->url}}">Read Now</a>]</div>
    </div>
    @endforeach
  </div>
</div>
@endsection
@section('js-section')
<script>
  $(document).ready(function() {
    var page = 2;
    $('.carousel').carousel({
      interval: 5000,
    });
    $('#hm-ts-main-container').multislider({
      interval: 5000,
      slideAll: false,
      duration: 700
    });
    $("#loadmore-button").click(function() {
      $.ajax({
        type: 'GET',
        url: '/loadmoreoffers?page=' + page,
        beforeSend: function() {
          $("#loadmore-button").prop('disabled', true);
          $("#loading-circle").css('display', 'inline');
        },
        complete: function() {
          $("#loading-circle").css('display', 'none');
          $("#loadmore-button").prop('disabled', false);
          page += 1;
        },
        success: function(data) {
          $.each(data.offers.data, function(index, offer) {
            var html =
              '<div class="hm-offer-container">' +
              '<div class="hm-offer-store-logo">' +
              '<a href="/store/' + offer.store.secondary_url + '" title="' + offer.store.title + '">' +
              '<img src="' + data.panel_assets_url + offer.store.logo_url + '"/>' +
              '</a>' +
              '</div>' +
              '<hr style="border-top: 1px dotted #d1d1d1; width: 100%;">' +
              '<div class="hm-offer-offertitle">' + offer.title + '</div>' +
              '<div class="hm-offer-type">' +
              '<span class="hm-offer-offertype-code">' + offer.location + ' ' + offer.type + '</span>' +
              '</div>' +
              '<span class="hm-offer-button" data-offerid="' + offer.id + '" data-offertitle="' + offer.title + '" data-offerlocation="' + offer.location + '" data-offertype="' + offer.type + '" data-offerdetails="' + offer.details + '" data-offercode="' + offer.code + '" data-offerexpiry="' + offer.expiry_date + '" data-storetitle="' + offer.store.title + '" data-siteurl="' + offer.store.network_url + '">'
              if (offer.type.toLowerCase() == "code") {
                html = html + 'VIEW CODE';
              } else if (offer.type.toLowerCase() == "sale") {
                html = html + 'GET DEAL';
              }
            '</span>' +
            '</div>';
            $("#hm-offers-container").append(html);
          });
          if (!data.hasmorepage) {
            $("#loadmore-button").css('display', 'none');
          }
        }
      });
    });
    // $(".js-offer-button").click(function(){
    //   $(this).data('storelogo');
    // });
  });
</script>
@endsection