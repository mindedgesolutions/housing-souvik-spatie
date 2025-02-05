<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationStatusController extends Controller
{
    public function applicationStatus()
    {
        return view('application-status.application-status');
    }

    public function waitListStatus()
    {
        return view('application-status.wait-list-status');
    }
}
