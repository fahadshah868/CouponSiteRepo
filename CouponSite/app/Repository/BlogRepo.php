<?php

namespace App\Repository;

use Cache;
use App\BlogCategory;
use App\Store;

class BlogRepo{
    
    public function getAllCategories(){
        $allblogcategories = Cache::remember('allblogcategories', config('constants.EXPIRES_AT'), function () {
            return BlogCategory::select('id','title','url')->where('is_active','y')->get();
        });
        return $allblogcategories;
    }
    public function getTopStores(){
        $topstores = Cache::remember('home_topstores', config('constants.EXPIRES_AT'), function () {
            return Store::select('id', 'secondary_url', 'logo_url')->where('is_topstore', 'y')->where('is_active', 'y')->limit(15)->get();
        });
        return $topstores;
    }

}