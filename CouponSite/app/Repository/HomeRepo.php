<?php

namespace App\Repository;

use Cache;
use App\Store;
use App\Category;
use App\CarouselOffer;
use App\Blog;
use App\Offer;

class HomeRepo
{

    public function getCarouselOffers()
    {
        $carouseloffers = Cache::remember('home_carousel_offers', config('constants.EXPIRES_AT'), function () {
            return CarouselOffer::select('id', 'title', 'location', 'type', 'code', 'starting_date', 'expiry_date', 'image_url', 'store_id')
                ->with(['store' => function ($q) {
                    $q->select('id', 'title', 'secondary_url', 'logo_url', 'network_url');
                }])
                ->whereHas('store', function ($q) {
                    $q->where('is_active', 'y');
                })
                ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where(function ($sq) {
                    $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                        ->orWhere('expiry_date', null);
                })
                ->orderBy('id', 'DESC')
                ->limit(15)->get();
        });
        return $carouseloffers;
    }
    public function getTopStores()
    {
        $topstores = Cache::remember('home_topstores', config('constants.EXPIRES_AT'), function () {
            return Store::select('id', 'secondary_url', 'logo_url')->where('is_topstore', 'y')->where('is_active', 'y')->limit(15)->get();
        });
        return $topstores;
    }
    public function getOffers($page)
    {
        $offers = Cache::remember('home_offers_page_' . $page, config('constants.EXPIRES_AT'), function () {
            return Offer::select('id', 'title', 'details', 'location', 'type', 'code', 'expiry_date', 'store_id')
                ->with(['store' => function ($q) {
                    $q->select('id', 'title', 'secondary_url', 'logo_url', 'network_url');
                }])
                ->whereHas('store', function ($q) {
                    $q->where('is_active', 'y');
                })
                ->where('display_at_home', 'y')
                ->where('is_active', 'y')
                ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where(function ($sq) {
                    $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                        ->orWhere('expiry_date', null);
                })
                ->orderBy('id', 'DESC')
                ->simplePaginate(16);
        });
        return $offers;
    }
    public function getPopularStores()
    {
        $popularstores = Cache::remember('home_popularstores', config('constants.EXPIRES_AT'), function () {
            return Store::select('id', 'title', 'secondary_url')
            ->where('is_popularstore', 'y')
            ->where('is_active', 'y')
            ->withCount(['offers' => function ($q) {
                $q->where('is_active', 'y')
                    ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                    ->where(function ($sq) {
                        $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                            ->orWhere('expiry_date', null);
                    });
            }])->limit(24)->get();
        });
        return $popularstores;
    }
    public function getPopularCategories()
    {
        $popularcategories = Cache::remember('home_popularcategories', config('constants.EXPIRES_AT'), function () {
            return Category::select('id', 'title', 'url')
            ->where('is_popularcategory', 'y')
            ->where('is_active', 'y')
            ->withCount(['offers' => function ($q) {
                $q->where('is_active', 'y')
                    ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                    ->where(function ($sq) {
                        $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                            ->orWhere('expiry_date', null);
                    });
            }])->limit(24)->get();
        });
        return $popularcategories;
    }
    public function getLatestBlogs()
    {
        $blogs = Cache::remember('home_latestblogs', config('constants.EXPIRES_AT'), function () {
            return Blog::select('id', 'url', 'title', 'image_url')->where('is_active', 'y')->orderBy('id', 'DESC')->limit(3)->get();
        });
        return $blogs;
    }
}
