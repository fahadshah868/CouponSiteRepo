<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function getPopularStoresList(){
        $data['status'] = true;
        return response($data);
    }
}
