<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Http\Requests\AllotmentApplication\NewApplicationRequest;
use App\Models\HousingDistrict;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HrmsController extends Controller
{
    public function create()
    {
        $hrms_data = getHrmsData();
        $hrmsDob = array_key_exists('dateOfBirth', $hrms_data) ? formatHrmsDate($hrms_data['dateOfBirth']) : '';
        $hrmsDoj = array_key_exists('dateOfJoining', $hrms_data) ? formatHrmsDate($hrms_data['dateOfJoining']) : '';
        $hrmsDor = array_key_exists('dateOfRetirement', $hrms_data) ? formatHrmsDate($hrms_data['dateOfRetirement']) : '';
        $hrmsGender = array_key_exists('gender', $hrms_data) ? $hrms_data['gender'] : '';
        $districts = HousingDistrict::orderBy('district_name', 'asc')->get();

        return view('applications.new-application', compact('hrms_data', 'districts', 'hrmsDob', 'hrmsDoj', 'hrmsDor', 'hrmsGender'));
    }

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

    public function success()
    {
        return view('applications.success');
    }
}
