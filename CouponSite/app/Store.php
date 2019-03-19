<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = "stores";
    protected $primaryKey = "id";

    //hasmany
    public function offer(){
        return $this->hasMany('App\Offer');
    }
    public function storecategory(){
        return $this->hasMany('App\StoreCategory');
    }
    // public function carouseloffer(){
    //     return $this->hasMany('App\CarouselOffer');
    // }
}
