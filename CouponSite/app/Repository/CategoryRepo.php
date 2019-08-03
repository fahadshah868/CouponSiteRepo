<?php

namespace App\Repository;
use Cache;
use App\Category;

class CategoryRepo{

    public function getAllTopCategories(){
        $alltopcategories = Cache::remember('alltopcategories', config('constants.EXPIRES_AT'), function () {
            return Category::select('id','title','url','logo_url')
            ->where('is_active','y')
            ->where('is_topcategory','y')
            ->get();
        });
        return $alltopcategories;
    }
    public function getAllCategories(){
        $allcategories = Cache::remember('allcategories', config('constants.EXPIRES_AT'), function () {
            return Category::select('id','title','url')
            ->where('is_active','y')
            ->orderByRaw('title + 0','ASC','title')->orderBy('title','ASC')
            ->withCount(['offers' => function($q){
                $q->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where(function($sq){
                    $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                    ->orWhere('expiry_date', null);
                });
            }])->get();
        });
        return $allcategories;
    }

}