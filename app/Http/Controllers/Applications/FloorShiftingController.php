<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FloorShiftingController extends Controller
{
    public function index()
    {
        return view('applications.floor-shifting');
    }

    public function store() {}
}
