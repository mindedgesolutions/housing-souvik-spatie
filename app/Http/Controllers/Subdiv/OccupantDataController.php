<?php

namespace App\Http\Controllers\Subdiv;

use App\Http\Controllers\Controller;
use App\Http\Requests\OccupantDataEntryRequest;
use App\Models\HousingApplicant;
use App\Models\HousingApplicantOfficialDetails;
use App\Models\HousingEstate;
use App\Models\HousingFlat;
use App\Models\HousingFlatOccupant;
use App\Models\HousingNewAllotmentApplication;
use App\Models\HousingOccupantLicense;
use App\Models\HousingOnlineApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

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
        $districts_array = config('lookup.districts'); // Coming from config/lookup.php
        $districts = (object)$districts_array; // Converting array to object
        $basicPayRange = basicPaybandCategories();

        return view('subdiv.occupant-data.occupant-data-form', compact('housingEstates', 'districts', 'basicPayRange'));
    }

    // ----------------------------------------------

    // public function store(OccupantDataEntryRequest $request)
    public function store(Request $request)
    {
        // dd($request->all());

        try {
            DB::beginTransaction();

            $wordCount = str_word_count(trim($request->occupant_name));
            $pieces = explode(" ", $request->occupant_name);

            if ($wordCount < 2) {
                $name = strtolower(substr($pieces[0], 0, 3));
            } else if ($wordCount == 2) {
                if ($pieces[0] == 'Dr.' || $pieces[0] == 'Dr' || $pieces[0] == 'dr.' || $pieces[0] == 'dr' || $pieces[0] == 'DR.' || $pieces[0] == 'DR') {
                    $name = strtolower(substr($pieces[1], 0, 3));
                } else {
                    $name = strtolower(substr($pieces[0], 0, 3)) . strtolower(substr($pieces[1], 0, 3));
                }
            } else {
                if ($pieces[0] == 'Dr.' || $pieces[0] == 'Dr' || $pieces[0] == 'dr.' || $pieces[0] == 'dr' || $pieces[0] == 'DR.' || $pieces[0] == 'DR') {
                    $name = strtolower(substr($pieces[1], 0, 3)) . strtolower(substr($pieces[2], 0, 3));
                } else {
                    $name = strtolower(substr($pieces[0], 0, 3)) . strtolower(substr($pieces[1], 0, 3));
                }
            }

            // Reference:
            // Old code vs. new code ----------------
            // $data2['oid'] = $online_application->online_application_id;
            // $data4['id'] = $housingFlatOccupant->flat_occupant_id;

            $username = $request->hrms_id;

            $user = User::updateOrCreate([
                'name' => $username,
            ], [
                'name' => $username,
                'email' => $request->app_email,
                'password' => bcrypt($username),
            ])->assignRole('occupant');

            // Insert data into housing_applicant table starts ----------------
            HousingApplicant::create([
                'uid' => $user->id,
                'applicant_name' => trim($request->occupant_name),
                'guardian_name' => trim($request->occupant_father_name),
                'date_of_birth' => date('Y-m-d', strtotime($request->dob)),
                'mobile_no' => $request->mobile,
                'gender' => $request->gender,
                'permanent_street' => trim($request->permanent_street),
                'permanent_city_town_village' => trim($request->permanent_city_town_village),
                'permanent_post_office' => trim($request->permanent_post_office),
                'permanent_pincode' => $request->permanent_pincode,
                'permanent_district' => $request->permanent_district,
                'permanent_present_same' => 0,
                'present_street' => trim($request->present_street),
                'present_city_town_village' => trim($request->present_city_town_village),
                'present_post_office' => trim($request->present_post_office),
                'present_pincode' => $request->present_pincode,
                'present_district' => $request->present_district,
            ]);
            // Insert data into housing_applicant table ends ----------------

            // Insert data into housing_applicant_official_detail table starts ----------------
            $official_details = HousingApplicantOfficialDetails::create([
                'uid' => $user->id,
                'ddo_id' => $request->ddo_id,
                'applicant_designation' => trim($request->designation),
                'applicant_headquarter' => trim($request->headquarter),
                'applicant_posting_place' => trim($request->posting_place),
                'pay_band_id' => $request->basic_pay_range,
                'pay_in_the_pay_band' => $request->basic_pay,
                // 'grade_pay' => $request->grade_pay,
                'date_of_joining' => date('Y-m-d', strtotime($request->doj)),
                'date_of_retirement' => date('Y-m-d', strtotime($request->dor)),
                'office_name' => trim($request->office_name),
                'office_street' => trim($request->office_address),
                'office_city_town_village' => trim($request->office_city),
                'office_post_office' => trim($request->office_po),
                'office_pin_code' => $request->office_pin,
                // 'gpf_no' => $request->gpf_no,
                'hrms_id' => $request->hrms_id,
                'office_district' => $request->office_district,
                'office_phone_no' => $request->office_phone,
            ]);
            // Insert data into housing_applicant_official_detail table ends ----------------

            // Insert + update data into housing_online_application table starts ----------------
            $online_application = HousingOnlineApplication::create([
                'applicant_official_detail_id' => $official_details->applicant_official_detail_id,
                'status' => "existing_occupant",
                'date_of_application' => null,
                'is_backlog_applicant' => 2
            ]);

            $app_no = 'EO' . trim(date('dmY')) . $online_application->online_application_id;

            $online_application->update(['application_no' => $app_no]);
            // Insert + update data into housing_online_application table ends ----------------

            // Insert data into housing_new_allotment_application table starts ----------------
            HousingNewAllotmentApplication::create([
                'online_application_id' => $online_application->online_application_id,
                'flat_type_id' => $request->flat_type,
            ]);
            // Insert data into housing_new_allotment_application table ends ----------------

            // Update housing_flat table starts ----------------
            HousingFlat::where('flat_id', $request->flat_id)->update(['flat_status_id' => 2]);
            // Update housing_flat table ends ----------------

            // Insert housing_flat_occupant table starts ----------------
            $housingFlatOccupant = HousingFlatOccupant::insertGetId([
                'online_application_id' => $online_application->online_application_id,
                'flat_id' => $request->flat_id,
                'allotment_date' => null,
            ], 'flat_occupant_id');
            // Insert housing_flat_occupant table ends ----------------

            // Insert housing_occupant_license table starts ----------------
            $expiry_date = Date::parse($request->issue_date)->addYears(3)->subDay()->format('Y-m-d');

            $housingOccupantLicense = HousingOccupantLicense::insertGetId([
                'flat_occupant_id' => $housingFlatOccupant,
                'license_issue_date' => date('Y-m-d', strtotime($request->issue_date)),
                'license_expiry_date' => $expiry_date,
                'existing_occupant_license_no' => $request->license_no,
                'authorised_or_not' => $request->occupant_status,
            ], 'occupant_license_id');

            if ($request->has('current_license')) {
                $file = $request->file('current_license');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(10) . time() . '-' . $file->getClientOriginalName();
                $directory = 'existing_occupant/Current Licence/' . $user->id;

                if (!Storage::disk('public')->exists($directory)) {
                    Storage::disk('public')->makeDirectory($directory);
                }
                $filePath = $file->storeAs($directory, $filename, 'public');
                $dbPath = Storage::url($filePath);

                // dd(Storage::url($filePath));
            }
            // Insert housing_occupant_license table ends ----------------

            DB::commit();

            Alert::success('Success', 'Occupant data saved successfully!');

            return redirect()->route('occupant-data.create');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()]);
        }
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

    public function getOccupantFlatNo(Request $request)
    {
        $flatNos = DB::table('housing_flat', 'hf')
            ->leftJoin('housing_flat_occupant', 'hf.flat_id', '=', 'housing_flat_occupant.flat_id')
            ->where('hf.estate_id', $request->estate_id)
            ->where('hf.flat_type_id', $request->flat_type_id)
            ->where('hf.block_id', $request->block_name)
            ->where('housing_flat_occupant.flat_id', null)
            ->select('hf.flat_id', 'hf.flat_no')
            ->orderBy('hf.flat_id')
            ->get();

        return response()->json(['flatNos' => $flatNos]);
    }
}
