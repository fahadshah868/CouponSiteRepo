<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "blogs";
    protected $primaryKey = "id";

    public function blogcategory(){
        return $this->belongsTo('App\BlogCategory','blog_category_id');
    }
    public function comments(){
        return $this->hasMany('App\BlogComment');
    }
}
