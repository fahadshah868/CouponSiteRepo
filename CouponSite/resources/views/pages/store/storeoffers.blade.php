@extends('layouts.app_layout')

@section('title','Store Coupons')

@section('content')
<!-- fo => filtered offers && sidebar => sb && detailbar => db -->
<div class="fo-main-container">
    <div class="fo-sb">
        <div class="fo-sb-storelogo-container">
            <a class="fo-sb-store-link" href="{{$store->network_url}}" target="_blank">
                <div class="fo-sb-storelogo">
                    <img src="{{$panel_assets_url.$store->logo_url}}" style="width: 100%; height: 100%;"/>
                </div>
                <div class="fo-sb-storetitle">{{$store->title}}</div>
            </a>
        </div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        <div class="fo-sb-offers-availability">{{count($store->offers)}} Offers Available</div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        @if(count($categories) > 0)
            <div class="fo-sb-content-container">
                <div class="fo-sb-content-heading">
                    <span>Filter By Category</span>
                    <span class="reset-category-filters" id="reset-category-filters">Reset</span>
                </div>
                <div class="fo-sb-content-body">
                    @foreach($categories as $category)
                    <label class="checkbox-container">{{$category{0}->category->title}}
                        <input type="checkbox" class="{{$category{0}->category->title}}">
                        <span class="checkmark"></span>
                    </label>
                    @endforeach
                </div>
            </div>
        @endif
        @if(count($alltopstores) > 0)
            <div class="fo-sb-content-container">
                <div class="fo-sb-content-heading">Top Stores</div>
                <div class="fo-sb-list-container">
                    <ul>
                        @foreach($alltopstores as $topstore)
                            <li>
                                <a class="fo-sb-list-item" href="/store/{{$topstore->secondary_url}}" title="{{$topstore->title}} Coupons">
                                    <span class="item-title">{{$topstore->title}}</span>
                                    <span class="coupons-count">{{$topstore->offers_count}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="fo-sb-content-container">
            <div class="fo-sb-content-heading">About {{$store->title}}</div>
            <div class="fo-sb-content-body">
                <span class="fo-store-details">{!!$store->description!!}</span>
            </div>
        </div>
    </div>
    <div class="fo-db">
        <div class="fo-db-heading">{{$store->title}} Coupons & Promo Codes</div>
        @if(count($store->offers) > 0)
        <div class="fo-db-offers-list-container">
            <ul>
                @foreach($store->offers as $offer)
                <li class="fo-db-offerbody-container {{$offer->category->title}}">
                    <div class="fo-db-anchor">
                        @foreach(explode(' ', $offer->anchor) as $anchor) 
                            <span>{{$anchor}}</span>
                        @endforeach
                    </div>
                    <div class="fo-db-action-container">
                        <div class="fo-db-offer-container">
                            <div class="fo-db-type-and-verified-container">
                                <div class="fo-db-offertype-code">{{$offer->location.' '.$offer->type}}</div>
                                @if(strcasecmp($offer->is_verified,'yes') == 0)
                                <div class="offer-verification-container"><i class="fa fa-check-circle"></i>Verfied</div>
                                @endif
                            </div>
                            <div class="fo-db-offertitle">{{$offer->title}}</div>
                            <div class="fo-db-offerdetails">{{$offer->details}}</div>
                            <div class="fo-db-offer-expires"><i class="fa fa-clock-o"></i>Expires: {{ Carbon\Carbon::parse($offer->expiry_date)->format('d/m/Y') }}</div>
                        </div>
                        <div class="fo-db-offer-button-container">
                            @if(strcasecmp($offer->location,'Online & In-Store') == 0 && strcasecmp($offer->type, 'Code') == 0)
                            <span class="offer-button" id="offer-button">
                                USE ONLINE
                            </span>
                            <span class="offer-button" id="offer-button">
                                USE IN-STORE
                            </span>
                            @else
                            <span class="offer-button" id="offer-button">
                                @if(strcasecmp($offer->type,"code") == 0)
                                    VIEW CODE
                                @else
                                    GET DEAL
                                @endif
                            </span>
                            @endif
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @else
        <div class="no-coupons-alert"><span>No Coupons Available For {{$store->title}}</span></div>
        @endif
    </div>
</div>
@endsection
@section('js-section')
<script>
    $(document).ready(function(){
        $(`#reset-category-filters`).click(function(){
            $('.checkbox-container').find('input:checkbox').prop(`checked`, false);
            $('li.fo-db-offerbody-container').not('.hidden').show();
            $('#reset-category-filters').css('display','none');
            if($('li.fo-db-offerbody-container:visible').length > 1){
                $(`.fo-sb-offers-availability`).html($('li.fo-db-offerbody-container:visible').length+` Offers Available`);
            }
            else{
                $(`.fo-sb-offers-availability`).html($('li.fo-db-offerbody-container:visible').length+` Offer Available`);
            }
        });
        $(`.checkbox-container input[type='checkbox']`).click(function(){
            if($('.checkbox-container').find('input:checkbox:checked').length > 0){
                $('#reset-category-filters').css('display','block');
                $('li.fo-db-offerbody-container').hide();
                $('.checkbox-container').find('input:checked').each(function () {
                    $('li.fo-db-offerbody-container.' + $(this).attr('class')).not('.hidden').show();
                });
            } 
            else{
                $('#reset-category-filters').css('display','none');
                $('li.fo-db-offerbody-container').not('.hidden').show();
            }
            if($('li.fo-db-offerbody-container:visible').length > 1){
                $(`.fo-sb-offers-availability`).html($('li.fo-db-offerbody-container:visible').length+` Offers Available`);
            }
            else{
                $(`.fo-sb-offers-availability`).html($('li.fo-db-offerbody-container:visible').length+` Offer Available`);
            }
        });
    });
</script>
@endsection