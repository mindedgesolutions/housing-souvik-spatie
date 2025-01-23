<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;

class CategoryShiftingController extends Controller
{
    public function index()
    {
        return view('applications.category-shifting');
    }

    public function store() {}
}
