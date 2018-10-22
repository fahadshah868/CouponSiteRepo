<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getPopularCategoriesList(){
        $data['status'] = true;
        return response($data);
    }
    public function getAllCategoriesList(){
        return view('pages.category.allcategories');
    }
}
