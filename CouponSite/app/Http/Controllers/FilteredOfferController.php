<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilteredOfferController extends Controller
{
    public function getFilteredOffers($filter){
        return view('pages.filteredoffer.filteredoffers');
    }
}
