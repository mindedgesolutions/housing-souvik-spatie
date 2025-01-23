<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HousingFlatType;
use App\Models\HousingBlock;

class FlatListEditController extends Controller
{
    public function HousingFlatListEdit(){
        $flatTypes = HousingFlatType::orderBy('flat_type', 'asc')->get();
        $blocks = HousingBlock::orderBy('block_name', 'asc')->get();
        return view('RHE-wise-flat-list-for-edit.RHE-wise-flat-list-for-edit', compact('flatTypes','blocks'));
    }
}
