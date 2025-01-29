<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Http\Requests\AllotmentApplication\NewApplicationRequest;
use App\Models\HousingApplicant;
use App\Models\HousingApplicantOfficialDetails;
use App\Models\HousingDdo;
use App\Models\HousingDistrict;
use App\Models\HousingEstate;
use App\Models\HousingPayBand;
use App\Models\HousingPayBandCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function create()
    {
        $hrms_data = getHRMSUserData(auth()->user()->name);

        $hrmsDob = array_key_exists('dateOfBirth', $hrms_data) ? formatHrmsDate($hrms_data['dateOfBirth']) : '';
        $hrmsDoj = array_key_exists('dateOfJoining', $hrms_data) ? formatHrmsDate($hrms_data['dateOfJoining']) : '';
        $hrmsDor = array_key_exists('dateOfRetirement', $hrms_data) ? formatHrmsDate($hrms_data['dateOfRetirement']) : '';
        $hrmsGender = array_key_exists('gender', $hrms_data) ? $hrms_data['gender'] : '';

        $districts = HousingDistrict::orderBy('district_name', 'asc')->get() ?? [];

        $ddoInfo = HousingDdo::where('ddo_code', $hrms_data['ddoId'])->first();

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

        $minScaleTo = $dbPayBands->min('scale_to');
        $minScaleId = $dbPayBands->firstWhere('scale_to', $minScaleTo)->pay_band_id;

        $maxScaleFrom = $dbPayBands->max('scale_from');
        $maxScaleId = $dbPayBands->firstWhere('scale_from', $maxScaleFrom)->pay_band_id;

        $empPayBandId = '';
        if ((int)$hrms_data['payInThePayBand'] <= $minScaleTo) {
            $empPayBandId = $minScaleId;
        } else if ((int)$hrms_data['payInThePayBand'] > $maxScaleFrom) {
            $empPayBandId = $maxScaleId;
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

        Session::put('estatePreferences', $estatePreferences);

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
        // Uncomment validations in NewApplicationRequest.php

        try {
            DB::beginTransaction();

            switch ($request->allotment_reason) {
                case 'General':
                    $reason = 'GEN';
                    break;
                case 'Single Earning Lady':
                    $reason = 'SEL';
                    break;
                case 'Transfer':
                    $reason = 'TRN';
                    break;
                case 'Recommended':
                    $reason = 'RCM';
                    break;
                case 'Legal Heir':
                    $reason = 'LGH';
                    break;
                case 'Physically Handicaped or Serious Illness':
                    $reason = 'PHI';
                    break;
            }

            $id = User::where('name', $request->hrms_id)->first()->id;

            // housing_applicant ------
            $gender = $request->gender == 'Male' ? 'M' : 'F';

            $applicantInfo = [
                'uid' => $id,
                'applicant_name' => $request->applicant_name,
                'guardian_name' => $request->father_husband_name,
                'date_of_birth' => date('Y-m-d', strtotime($request->dob)),
                'mobile_no' => (int)$request->mobile_no,
                'gender' => $gender,
                'permanent_street' => $request->p_address,
                'permanent_city_town_village' => $request->p_city_town_village,
                'permanent_post_office' => $request->p_post_office,
                'permanent_pincode' => (int)$request->p_pin_code,
                'permanent_district' => (int)$request->p_district ?? (int)$request->p_district_value,
                'permanent_present_same' => $request->has('same_as_permanent') ? 1 : 0,
                'present_street' => $request->present_address,
                'present_city_town_village' => $request->present_city_town_village,
                'present_post_office' => $request->present_post_office,
                'present_pincode' => (int)$request->present_pin_code,
                'present_district' => (int)$request->present_district ?? (int)$request->present_district_value,
            ];

            $applicantId = HousingApplicant::create($applicantInfo)->housing_applicant_id;

            // housing_applicant_official_detail ------
            $applicantOfficeInfo = [
                'uid' => $id,
                'ddo_id' => $request->ddo_id,
                'applicant_designation' => $request->designation,
                'applicant_headquarter' => $request->headquarter,
                'applicant_posting_place' => $request->place_of_posting,
                'pay_band_id' => $request->basic_pay_range_value,
                'pay_in_the_pay_band' => $request->basic_pay,
                'grade_pay' => $request->grade_pay,
                'date_of_joining' => date('Y-m-d', strtotime($request->doj)),
                'date_of_retirement' => date('Y-m-d', strtotime($request->dor)),
                'office_name' => $request->name_of_office,
                'office_street' => $request->office_address,
                'office_city_town_village' => $request->office_city_town_village,
                'office_post_office' => $request->office_post_office,
                'office_pin_code' => $request->office_pin_code,
                'gpf_no' => null,
                'hrms_id' => $request->hrms_id,
                'office_district' => $request->o_district ?? $request->o_district_value,
                'office_phone_no' => $request->office_phn_no,
                'is_active' => 1,
                'housing_applicant_id' => $applicantId,
            ];

            $applicantOfficeId = HousingApplicantOfficialDetails::create($applicantOfficeInfo)->applicant_official_detail_id;

            if ($request->has('doc_payslip')) {
                $file = $request->file('doc_payslip');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(10) . time() . '-' . $file->getClientOriginalName();
                $directory = 'uploads/documents/' . Str::slug($request->applicant_name);

                // if (!Storage::disk('public')->exists($directory)) {
                //     Storage::disk('public')->makeDirectory($directory);
                // }
                // $filePath = $file->storeAs($directory, $filename, 'public');

                // dd(Storage::url($filePath));
            }

            DB::commit();

            Alert::success('Done!', 'Application submitted successfully');

            // return redirect()->route('dashboard');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('An error occurred: ' . $th->getMessage());
        }
    }

    // ------

    public function view($id)
    {
        $decId = Crypt::decrypt($id);

        return view('applications.success');
    }
}
