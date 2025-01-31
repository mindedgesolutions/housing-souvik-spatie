<?php

namespace App\Http\Middleware;

use App\Models\HousingOnlineApplication;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApplyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userid = Auth()->user()->id;
        $status = HousingOnlineApplication::whereHas('housingApplicantOfficialDetails', function ($query) use ($userid) {
            $query->where('uid', $userid);
        })->first();

        if ($status && $status->status && $request->route()->getName() !== 'hrms.view') {
            return redirect()->route('hrms.view');
        }

        return $next($request);
    }
}
