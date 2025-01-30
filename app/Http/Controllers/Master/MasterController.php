<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\HousingPayBandCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MasterController extends Controller
{
    public function getFlatType(Request $request)
    {
        $type = HousingPayBandCategory::where('pay_band_id', $request->payBand)->first();

        return response()->json(['type' => $type->flatType->flat_type]);
    }

    // ------

    public function getEstatePreference()
    {
        $estatePreferences = Session::get('estatePreferences');

        $estatePreferences = array_filter($estatePreferences->toArray(), function ($estate) {
            if (request()->first && request()->second) {
                return $estate['estate_id'] != request()->first && $estate['estate_id'] != request()->second;
            } else {
                return $estate['estate_id'] != request()->first;
            }
        });

        return response()->json(['estatePreferences' => $estatePreferences]);
    }

    // ------
}
