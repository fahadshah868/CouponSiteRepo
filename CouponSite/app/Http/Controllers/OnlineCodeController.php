<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineCodeController extends Controller
{
    public function getTopOnlineCodesList(){
        $data['status'] = true;
        return response($data);
    }
}
