<?php

namespace App\Repository;

use Carbon\Carbon;
use Cache;
use App\Store;
use App\Category;
use App\CarouselOffer;
use App\Blog;
use App\Offer;

class Home
{

    public function getCarouselOffers()
    {
        $carouseloffers = Cache::remember('home_carousel_offers', Carbon::now()->addMinutes(5), function () {
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
        $topstores = Cache::remember('home_topstores', Carbon::now()->addMinutes(5), function () {
            return Store::select('id', 'secondary_url', 'logo_url')->where('is_topstore', 'y')->where('is_active', 'y')->limit(15)->get();
        });
        return $topstores;
    }
    public function getOffers($page)
    {
        $offers = Cache::remember('home_offers_page_' . $page, Carbon::now()->addMinutes(5), function () {
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
        $popularstores = [];
        if (Cache::has('home_popularstores')) {
            $popularstores = Cache::get('home_popularstores');
        } else if (Cache::has('allstores')) {
            $popularstores = Cache::remember('home_popularstores', Carbon::now()->addMinutes(5), function () {
                return Cache::get('allstores')->select('id','title','secondary_url')
                ->where('is_popularstore', 'y')
                ->limit(24)->get();
            });
        } else {
            $popularstores = Cache::remember('home_popularstores', Carbon::now()->addMinutes(5), function () {
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
        }
        return $popularstores;
    }
    public function getPopularCategories()
    {
        $popularcategories = [];
        if (Cache::has('home_popularcategories')) {
            $popularcategories = Cache::get('home_popularcategories');
        } else if (Cache::has('allcategories')) {
            $popularcategories = Cache::remember('home_popularcategories', Carbon::now()->addMinutes(5), function () {
                return Cache::get('allcategories')->select('id','title','url')
                ->where('is_popularcategory', 'y')
                ->limit(24)->get();
            });
        } else {
            $popularcategories = Cache::remember('home_popularcategories', Carbon::now()->addMinutes(5), function () {
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
        }
        return $popularcategories;
    }
    public function getLatestBlogs()
    {
        $blogs = Cache::remember('home_latestblogs', Carbon::now()->addMinutes(5), function () {
            return Blog::select('id', 'url', 'title', 'image_url')->where('is_active', 'y')->orderBy('id', 'DESC')->limit(3)->get();
        });
        return $blogs;
    }
}
