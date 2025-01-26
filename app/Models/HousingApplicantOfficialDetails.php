<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingApplicantOfficialDetails extends Model
{
    use HasFactory;

    protected $table = 'housing_applicant_official_detail';

    protected $primaryKey = 'applicant_official_detail_id';

    protected $fillable = [
        'uid',
        'ddo_id',
        'applicant_designation',
        'applicant_headquarter',
        'applicant_posting_place',
        'pay_band_id',
        'pay_in_the_pay_band',
        'grade_pay',
        'date_of_joining',
        'date_of_retirement',
        'office_name',
        'office_street',
        'office_city_town_village',
        'office_post_office',
        'office_pin_code',
        'gpf_no',
        'hrms_id',
        'office_district',
        'office_phone_no',
        'is_active',
        'housing_applicant_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'id');
    }

    public function housingOnlineApplication()
    {
        return $this->hasOne(HousingOnlineApplication::class, 'applicant_official_detail_id', 'applicant_official_detail_id');
    }
}
