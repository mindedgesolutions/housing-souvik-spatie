<?php

namespace App\Http\Controllers;

use App\Models\HousingDdo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HrmsDdoController extends Controller
{
    public function ddoDesignations(Request $request)
    {
        $designations = HousingDdo::select('ddo_id', 'ddo_designation')->where('district_code', $request->ddoDistrict)->orderBy('ddo_designation')->get();

        return response()->json(['designations' => $designations], Response::HTTP_OK);
    }
}
