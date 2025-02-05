<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllotmentDetailsController extends Controller
{
    public function newAllotment()
    {
        return view('allotment-details.new-allotment');
    }

    public function categoryShifting()
    {
        return view('allotment-details.category-shifting');
    }

    public function verticalShifting()
    {
        return view('allotment-details.vertical-shifting');
    }
}
