<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingApplicant extends Model
{
    use HasFactory;

    protected $table = 'housing_applicant';

    protected $primaryKey = 'housing_applicant_id';

    public $timestamps = false;

    protected $fillable = [
        'uid',
        'applicant_name',
        'guardian_name',
        'date_of_birth',
        'mobile_no',
        'gender',
        'permanent_street',
        'permanent_city_town_village',
        'permanent_post_office',
        'permanent_pincode',
        'permanent_district',
        'permanent_present_same',
        'present_street',
        'present_city_town_village',
        'present_post_office',
        'present_pincode',
        'present_district',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'id');
    }
}
