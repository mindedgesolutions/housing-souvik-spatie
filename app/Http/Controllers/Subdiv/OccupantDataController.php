<?php

namespace App\Http\Controllers\Subdiv;

use App\Http\Controllers\Controller;
use App\Models\HousingEstate;
use App\Models\HousingFlat;
use Illuminate\Http\Request;

class OccupantDataController extends Controller
{
    // ----------------------------------------------

    public function index()
    {
        return view('subdiv.occupant-data.occupant-data-list');
    }

    // ----------------------------------------------

    public function create()
    {
        $housingEstates = HousingEstate::where('subdiv_id', auth()->user()->userDetail->subdiv_id)->get();

        return view('subdiv.occupant-data.occupant-data-form', compact('housingEstates'));
    }

    // ----------------------------------------------

    public function store(Request $request)
    {
        //
    }

    // ----------------------------------------------

    public function show(string $id)
    {
        //
    }

    // ----------------------------------------------

    public function edit(string $id)
    {
        //
    }

    // ----------------------------------------------

    public function update(Request $request, string $id)
    {
        //
    }

    // ----------------------------------------------
    public function destroy(string $id)
    {
        //
    }

    // ----------------------------------------------

    public function getOccupantFlatType(Request $request)
    {
        $flatTypes = HousingFlat::where('estate_id', $request->estate_id)
            ->join('housing_flat_type', 'housing_flat.flat_type_id', '=', 'housing_flat_type.flat_type_id')
            ->select('housing_flat.flat_type_id', 'housing_flat_type.flat_type')
            ->distinct()
            ->orderBy('housing_flat_type.flat_type')
            ->get();

        return response()->json(['flatTypes' => $flatTypes]);
    }

    // ----------------------------------------------

    public function getOccupantBlock(Request $request)
    {
        $blocks = HousingFlat::where('estate_id', $request->estate_id)
            ->where('flat_type_id', $request->flat_type_id)
            ->join('housing_block', 'housing_flat.block_id', '=', 'housing_block.block_id')
            ->select('housing_block.block_id', 'housing_block.block_name')
            ->distinct()
            ->orderBy('block_name')
            ->get();

        return response()->json(['blocks' => $blocks]);
    }

    // ----------------------------------------------

    public function getOccupantFlatNo(Request $request) {}
}
