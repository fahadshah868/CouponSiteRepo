@extends('layouts.app_layout')

@section('title','All Stores')

@section('content')

<div class="eo-main-container">
    <div class="eo-ts-main-container">
        <div class="eo-ts-heading" style="text-align: center;">
            Top {{ $event->title }} Stores
        </div>
        <div class="eo-ts-list-container">
            @foreach($stores as $store)
            <div class="eo-ts-container">
                <a href="/store/{{$store{0}->offer->store->secondary_url}}" class="eo-ts-link">
                    <div class="eo-ts-logo">
                        <img src="{{$panel_assets_url}}{{$store{0}->offer->store->logo_url}}"/>
                    </div>
                    <div class="eo-ts-title">{{$store{0}->offer->store->title}}</div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="event-offers-main-container">
      <!--Heading-->
      <div class="event-offers-heading">Top {{ $event->title }} Offers, Deals & Coupon Codes</div>
      <!--Products-->
      <div class="event-offers-container js-offer" id="event-offers-container">
        @foreach($event->eventoffers as $eventoffer)
        <div class="event-offer-container">
          <div class="event-offer-store-logo">
            <a href="/store/{{$eventoffer->offer->store->secondary_url}}" title="{{$eventoffer->offer->store->title}}">
              <img src="{{$panel_assets_url.$eventoffer->offer->store->logo_url}}"/>
            </a>
          </div>
          <hr style="border-top: 1px dotted #d1d1d1; width: 100%;">
          <div class="event-offer-offertitle">
            {{$eventoffer->offer->title}}
          </div>
          <div class="event-offer-type">
            <span class="event-offer-offertype-code">{{$eventoffer->offer->location}} {{$eventoffer->offer->type}}</span>
          </div>
          @if(strcasecmp($eventoffer->offer->location,'Online & In-Store') == 0)
          <span class="event-offer-button js-offer-button"
              data-offerid="{{$eventoffer->offer->id}}" data-offertitle="{{$eventoffer->offer->title}}" 
              data-offerlocation="Online" data-offertype="{{$eventoffer->offer->type}}" 
              data-offerdetails="{{$eventoffer->offer->details}}" data-offercode="{{$eventoffer->offer->code}}" 
              data-storetitle="{{$eventoffer->offer->store->title}}" data-storelogo="{{$panel_assets_url.$eventoffer->offer->store->logo_url}}" data-siteurl="{{$eventoffer->offer->store->secondary_url}}"
              data-offerexpiry="{{$eventoffer->offer->expiry_date}}" data-navurl="{{$eventoffer->offer->store->network_url}}">
              USE ONLINE
          </span>
          <span class="event-offer-button js-offer-button" data-offerid="{{$eventoffer->offer->id}}" data-offerlocation="In-Store" data-offertype="{{$eventoffer->offer->type}}">
              USE IN-STORE
          </span>
          @elseif(strcasecmp($eventoffer->offer->location,'In-Store') == 0)
          <span class="event-offer-button js-offer-button" 
              data-offerid="{{$eventoffer->offer->id}}" data-offertitle="{{$eventoffer->offer->title}}"
              data-offerlocation="{{$eventoffer->offer->location}}" data-offertype="{{$eventoffer->offer->type}}"
              data-offerdetails="{{$eventoffer->offer->details}}" data-offercode="{{$eventoffer->offer->code}}" 
              data-storetitle="{{$eventoffer->offer->store->title}}" data-storelogo="{{$panel_assets_url.$eventoffer->offer->store->logo_url}}" data-siteurl="{{$eventoffer->offer->store->secondary_url}}"
              data-offerexpiry="{{$eventoffer->offer->expiry_date}}" data-navurl="{{$eventoffer->offer->store->network_url}}">
              Show Coupon
          </span>
          @else
          <span class="event-offer-button js-offer-button" 
              data-offerid="{{$eventoffer->offer->id}}" data-offertitle="{{$eventoffer->offer->title}}"
              data-offerlocation="{{$eventoffer->offer->location}}" data-offertype="{{$eventoffer->offer->type}}"
              data-offerdetails="{{$eventoffer->offer->details}}" data-offercode="{{$eventoffer->offer->code}}" 
              data-storetitle="{{$eventoffer->offer->store->title}}" data-storelogo="{{$panel_assets_url.$eventoffer->offer->store->logo_url}}" data-siteurl="{{$eventoffer->offer->store->secondary_url}}"
              data-offerexpiry="{{$eventoffer->offer->expiry_date}}" data-navurl="{{$eventoffer->offer->store->network_url}}">
            @if(strcasecmp($eventoffer->offer->type,"code") == 0)
                VIEW CODE
            @else
                GET DEAL
            @endif
          </span>
          @endif
        </div>
        @endforeach
      </div>
    </div>
</div>

@endsection