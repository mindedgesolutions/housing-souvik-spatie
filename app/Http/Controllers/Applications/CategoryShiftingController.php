<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryShiftingController extends Controller
{
    public function create()
    {
        return view('applications.category-shifting');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
