<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = "stores";
    protected $primaryKey = "id";
    public $timestamps = true;

    //hasmany
    public function offers(){
        return $this->hasMany('App\Offer');
    }
    public function storecategories(){
        return $this->hasMany('App\StoreCategory');
    }
    public function carouseloffers(){
        return $this->hasMany('App\CarouselOffer');
    }
}
