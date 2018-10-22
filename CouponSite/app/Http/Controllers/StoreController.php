<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function getPopularStoresList(){
        $data['status'] = true;
        return response($data);
    }
    public function getAllStoresList(){
        return view('pages.store.allstores');
    }
}
