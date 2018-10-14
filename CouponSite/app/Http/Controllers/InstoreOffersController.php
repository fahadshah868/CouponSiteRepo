<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstoreOffersController extends Controller
{
    public function getTopInstoreOffersList(){
        $data['status'] = true;
        return response($data);
    }
}
