<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Http\Requests\AllotmentApplication\NewApplicationRequest;
use App\Models\HousingDdo;
use App\Models\HousingDistrict;
use App\Models\HousingEstate;
use App\Models\HousingPayBand;
use App\Models\HousingPayBandCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HrmsController extends Controller
{
    public function getFlatType(Request $request)
    {
        $type = HousingPayBandCategory::where('pay_band_id', $request->payBand)->first();

        return response()->json(['type' => $type->flatType->flat_type]);
    }

    // ------

    public function getEstatePreference()
    {
        $estatePreferences = Cache::get('estatePreferences');

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

    public function create()
    {
        $hrms_data = getHRMSUserData(auth()->user()->name);

        $hrmsDob = array_key_exists('dateOfBirth', $hrms_data) ? formatHrmsDate($hrms_data['dateOfBirth']) : '';
        $hrmsDoj = array_key_exists('dateOfJoining', $hrms_data) ? formatHrmsDate($hrms_data['dateOfJoining']) : '';
        $hrmsDor = array_key_exists('dateOfRetirement', $hrms_data) ? formatHrmsDate($hrms_data['dateOfRetirement']) : '';
        $hrmsGender = array_key_exists('gender', $hrms_data) ? $hrms_data['gender'] : '';

        $districts = HousingDistrict::orderBy('district_name', 'asc')->get() ?? [];

        $ddoInfo = HousingDdo::where('ddo_code', $hrms_data['ddoId'])->select('treasury_id', 'district_code', 'ddo_designation', 'ddo_address')->first();

        // Pay band related starts here ------
        $payBands = [];
        $dbPayBands = HousingPayBandCategory::orderBy('pay_band_id')->get();
        foreach ($dbPayBands as $payBand) {
            if ($payBand->scale_from == 0 && $payBand->scale_to != 0) {
                $label = '(Up to Rs.' . $payBand->scale_to . '/-)';
            } else if ($payBand->scale_from != 0 && $payBand->scale_to != 0) {
                $label = '(Rs.' . $payBand->scale_from . '/ Up to Rs.' . $payBand->scale_to . '/-)';
            } else {
                $label = '(Rs.' . $payBand->scale_from . '/- and above)';
            }
            $payBands[$payBand->pay_band_id] = $label;
        }

        $empPayBandId = '';
        if ((int)$hrms_data['payInThePayBand'] <= 25999) {
            $empPayBandId = 1;
        } else if ((int)$hrms_data['payInThePayBand'] > 95100) {
            $empPayBandId = 5;
        } else {
            $empPayBandId = DB::table('housing_pay_band_category')
                ->whereRaw('cast(? as integer) >= scale_from', [$hrms_data['payInThePayBand']])
                ->whereRaw('cast(? as integer) <= scale_to', [$hrms_data['payInThePayBand']])
                ->first()->pay_band_id;
        }
        // Pay band related ends here ------

        // Allotment category and reasons related start here ------
        $flatType = HousingPayBand::where('pay_band_id', $empPayBandId)->first();

        $allotmentReasons = [];

        switch (trim($flatType->housingFlatType->flat_type)) {
            case 'A+':
                $allotmentReasons = DB::table('housing_roasterAplus_master')->distinct('category')->get();
                break;
            case 'A':
                $allotmentReasons = DB::table('housing_roaster4ab_master')->distinct('category')->get();
                break;
            case 'B':
                $allotmentReasons = DB::table('housing_roaster4ab_master')->distinct('category')->get();
                break;
            default:
                $allotmentReasons = DB::table('housing_roaster4cd_master')->distinct('category')->get();
                break;
        }
        // Allotment category and reasons related end here ------

        // Estate preferences related starts here ------
        $estatePreferences = HousingEstate::where('district_code', $hrms_data['presentDistrictCode'])
            ->whereHas('housingFlat.housingPayBandCategory', function ($query) use ($empPayBandId) {
                $query->where('pay_band_id', $empPayBandId);
            })
            ->whereHas('housingTreasuryEstateMapping', function ($query) use ($ddoInfo) {
                $query->where('treasury_id', $ddoInfo->treasury_id);
            })
            ->orderBy('estate_name')
            ->get();
        // Estate preferences related ends here ------

        Cache::put('estatePreferences', $estatePreferences, now()->addMinutes(10));

        return view('applications.new-application', compact(
            'hrms_data',
            'districts',
            'payBands',
            'empPayBandId',
            'hrmsDob',
            'hrmsDoj',
            'hrmsDor',
            'hrmsGender',
            'flatType',
            'allotmentReasons',
            'ddoInfo',
            'estatePreferences'
        ));
    }

    // ------

    public function store(NewApplicationRequest $request)
    {
        // $request->validate([
        //     'applicant_name' => 'required',
        //     'email' => 'required',
        // ]);

        // if (isset($validator) && $validator->fails()) {
        //     return back()->with('errors', $validator->messages()->all()[0])->withInput();
        // }

        // $is_inserted = 1;
        // if ($is_inserted) {
        //     Alert::success('Done!', 'Application Submitted Successfully');
        // } else {
        //     Alert::error('Error!', 'Failed to Submit Application');
        // }

        try {
            DB::beginTransaction();

            if ($request->has('doc_payslip')) {
                $file = $request->file('doc_payslip');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(10) . time() . '-' . $file->getClientOriginalName();
                $directory = 'uploads/documents/' . Str::slug($request->applicant_name);

                if (!Storage::disk('public')->exists($directory)) {
                    Storage::disk('public')->makeDirectory($directory);
                }
                $filePath = $file->storeAs($directory, $filename, 'public');

                // dd(Storage::url($filePath));
            }

            DB::commit();

            return redirect()->route('hrms.success');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    // ------

    public function view($id)
    {
        $decId = Crypt::decrypt($id);

        return view('applications.success');
    }
}
