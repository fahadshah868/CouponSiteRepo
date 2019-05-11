<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table = "blog_categories";
    protected $primaryKey = "id";

    public function blogs(){
        return $this->hasMany('App\Blog');
    }
}
