<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingOnlineApplication extends Model
{
    use HasFactory;

    protected $table = 'housing_online_application';

    protected $primaryKey = 'online_application_id';

    protected $fillable = [
        'applicant_official_detail_id',
        'status',
        'date_of_application',
        'date_of_verified',
        'uploaded_app_form',
        'application_no',
        'is_backlog_applicant',
        'computer_serial_no',
        'remarks'
    ];

    public function housingApplicantOfficialDetails()
    {
        return $this->belongsTo(HousingApplicantOfficialDetails::class, 'applicant_official_detail_id', 'applicant_official_detail_id');
    }
}
