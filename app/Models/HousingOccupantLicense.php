<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingOccupantLicense extends Model
{
    use HasFactory;

    protected $table = 'housing_occupant_license';

    protected $primaryKey = 'occupant_license_id';

    protected $fillable = [
        'flat_occupant_id',
        'license_application_id',
        'license_issue_date',
        'license_expiry_date',
        'existing_occupant_license_no',
        'uploaded_licence',
        'license_no',
        'possession_date',
        'release_date',
        'authorised_or_not',
    ];
}
