<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Http\Requests\AllotmentApplication\FloorShiftRequest;
use App\Models\HousingDdo;
use App\Models\HousingDistrict;
use App\Models\HousingPayBandCategory;
use Illuminate\Support\Facades\DB;

class FloorShiftingController extends Controller
{
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

        return view('applications.floor-shifting', compact(
            'hrms_data',
            'hrmsDob',
            'hrmsDoj',
            'hrmsDor',
            'hrmsGender',
            'districts',
            'ddoInfo',
            'payBands',
            'empPayBandId',
        ));
    }

    public function store(FloorShiftRequest $request)
    {
        dd($request->all());
    }
}
