@extends('layouts.app_layout')

@section('title','Filtered Coupons')

@section('content')

<div class="fo-main-container">
    <div class="fo-sidebar">
        <div class="fo-sidebar-offers-availability">950 Offers Available</div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">Top Stores</div>
            <div class="fo-sidebar-list-container">
                <ul>
                    @for($i=1; $i<=100; $i++)
                    <li>
                        <a class="fo-sidebar-list-item" href="#" title="Target coupons">
                            <span class="item-title">Target</span>
                            <span class="coupons-count">40</span>
                        </a>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">Top Categories</div>
            <div class="fo-sidebar-list-container">
                <ul>
                    @for($i=1; $i<=100; $i++)
                    <li>
                        <a class="fo-sidebar-list-item" href="#" title="Target coupons">
                            <span class="item-title">Clothing</span>
                            <span class="coupons-count">213</span>
                        </a>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">Clothing</div>
            <div class="fo-sidebar-content-body">
                <span class="fo-store-details">Kohl's Department Stores, Inc. operates department stores in the United States. The company offers apparel, footwear, accessories, and home products to middle-income customers.</span>
            </div>
        </div>
    </div>
    <div class="fo-detailbar">
        <div class="fo-detailbar-heading">Clothing Coupons & Promo Codes</div>
        <section id="filtered-offers">
        @include('partialviews.filteredoffers')
        </section>
    </div>
</div>


<script type="text/javascript">
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');  
        getArticles(url);
    });
    function getArticles(url) {
        $.ajax({
            url : url
        }).done(function (data) {
            $('#filtered-offers').html(data);  
        }).fail(function () {
            alert('Articles could not be loaded.');
        });
    }
</script>

@endsection