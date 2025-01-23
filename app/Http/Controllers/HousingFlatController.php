<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Models\HousingFlatType;
use App\Models\HousingBlock;
use App\Models\HousingFlatStatus;
use App\Models\HousingFlat;
use App\Models\HousingEstate;

class HousingFlatController extends Controller
{
    public function housingFlatAdd(){
        $flatTypes = HousingFlatType::all();
        $blocks = HousingBlock::orderBy('block_name', 'asc')->get();
        $flat_status_list = HousingFlatStatus::all();
        return view('housing-flat.housing-flat-add',compact('flatTypes','blocks','flat_status_list'));
    }

    public function housingFlatStore(Request $request){
        // dd($request);
        $request->validate([
            'rhe_name' => 'required',
            'flat_type' => 'required',
            'block_name_list' => 'required',
            'floor_no' => 'required',
            'flat_number' => 'required',
            'flat_status_list' => 'required',
            'remarks' => 'nullable|string'
        ]);

        if (isset($validator) && $validator->fails()) {

            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        }

        $housingFlat = new HousingFlat();
        $housingFlat->estate_id = $request->rhe_name;
        $housingFlat->flat_type_id = $request->flat_type;
        $housingFlat->block_id = $request->block_name_list;
        $housingFlat->floor = $request->floor_no;
        $housingFlat->flat_no = $request->flat_number;
        $housingFlat->flat_status_id = $request->flat_status_list;
        $housingFlat->remarks = $request->remarks;
        $is_inserted = $housingFlat->save();

        // dd ($request);

        if($is_inserted){
            Alert::success('Done !', 'Data Added Successfully');
        }else{
            Alert::error('Error !', 'Failed to Add Data');
        }
        
        return redirect('/housing-flat-add');
    }

    public function HousingFlatEdit(){

        $rhe_list = HousingEstate::all();
        return view('housing-flat.housing-flat-edit')->with('rhe_list',$rhe_list);
    }

    public function getFlatType(Request $request){

        $response = HousingFlat::join('housing_flat_type', 'housing_flat_type.flat_type_id', '=', 'housing_flat.flat_type_id')
        ->groupBy('housing_flat_type.flat_type_id')
        ->groupBy('housing_flat_type.flat_type')
        ->orderBy('housing_flat_type.flat_type', 'ASC')
        ->where('estate_id',$request->estate_id)
        ->get(['housing_flat_type.flat_type_id as id','housing_flat_type.flat_type as name']);

        // dd($response);

        return response()->json($response);
        
    }

    public function getFlatBlock(Request $request){

        $response = HousingFlat::join('housing_block', 'housing_block.block_id', '=', 'housing_flat.block_id')
        ->groupBy('housing_block.block_id')
        ->groupBy('housing_block.block_name')
        ->orderBy('housing_block.block_name', 'ASC')
        ->where('estate_id',$request->estate_id)
        ->where('housing_flat.flat_type_id',$request->flat_type)
        ->get(['housing_block.block_id as id','housing_block.block_name as name']);

        // dd($response);

        return response()->json($response);  
    }

    public function getFlatListView(){
        $response = new getHousingEstate();
        dd($response);
        // return $response->housing_estate->estate_name;
    }
}

