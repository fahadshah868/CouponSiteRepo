@extends('layouts.app_layout')

@section('title','Filtered Coupons')

@section('content')

<div class="fo-main-container">
    <div class="fo-sb">
        <div class="fo-sb-offers-availability">{{$filteredoffers->total()}} Offers Available</div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        @if(count($stores) > 0)
        <div class="fo-sb-content-container">
            <div class="fo-sb-content-heading">
                <span>Filter By Store</span>
                <span class="reset-category-filters">Reset</span>
            </div>
            <div class="fo-sb-content-body">
                @foreach($stores as $store)
                <label class="checkbox-container">{{$store{0}->store->title}}
                    <input type="checkbox" class="store-filter" id="{{$store{0}->store->id}}">
                    <span class="checkmark"></span>
                </label>
                @endforeach
            </div>
        </div>
        @endif
        <div class="fo-sb-content-container">
            <div class="fo-sb-content-heading">Top Categories</div>
            <div class="fo-sb-list-container">
                <ul>
                    @foreach($alltopcategories as $topcategory)
                        @if($topcategory->id != $category->id)
                        <li>
                            <a class="fo-sb-list-item" href="/coupons/{{$topcategory->url}}" title="{{$topcategory->title}} Coupons">
                                <span class="item-title">{{$topcategory->title}}</span>
                                <span class="coupons-count">{{$topcategory->offers_count}}</span>
                            </a>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="fo-sb-content-container">
            <div class="fo-sb-content-heading">{{$category->title}}</div>
            <div class="fo-sb-content-body">
                <span class="fo-store-details">{!!$category->description!!}</span>
            </div>
        </div>
    </div>
    <div class="fo-db">
        <div class="fo-db-heading">{{$category->title}} Coupons & Promo Codes</div>
        @if(count($filteredoffers) > 0)
        <section id="filtered-offers">
        @include('partialviews.filteredoffers')
        </section>
        @else
        <div class="no-coupons-alert">No Coupons Available For {{$category->title}}</div>
        @endif
    </div>
</div>
@endsection
@section('js-section')
<script>
    $(`body`).on(`click`, `.pagination a`, function(e) {
        e.preventDefault();
        var url = $(this).attr(`href`);  
        getArticles(url);
    });
    function getArticles(url) {
        $.ajax({
            url : url
        }).done(function (data) {
            $(`#filtered-offers`).html(data);  
        }).fail(function () {
            alert(`something went wrong.`);
        });
    }
    $(`.checkbox-container input[type="checkbox"]`).click(function(){
        var stores = [];
        $(`.checkbox-container`).find(`input:checked`).each(function () {
            stores.push($(this).attr(`id`));
        });
        console.log(stores[stores.length-1]);
        console.log(stores);
        if(stores.length > 0){
            $.ajax({
                type:`GET`,
                url:`/applymorefilters/`+stores,
                data: ``,
                dataType: 'json',
                traditional: true,
                beforeSend: function(){
                    //todo
                },
                complete: function(){
                    //todo
                },
                success:function(data){
                    $.each(data.filteredoffers, function (index, offer) {
                        alert(offer.id);
                        console.log(offer);
                    })
                }
            });
        }
    });
</script>
@endsection