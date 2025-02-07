<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $hrmsData = getHRMSUserData($user->name);

        return view('dashboard', compact('user', 'hrmsData'));
    }

    public function subdiv()
    {
        $user = Auth::user();

        return view('subdiv.dashboard', compact('user'));
    }

    public function division()
    {
        $user = Auth::user();

        return view('division.dashboard', compact('user'));
    }
}
