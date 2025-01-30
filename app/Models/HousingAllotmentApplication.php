<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingAllotmentApplication extends Model
{
    use HasFactory;

    protected $table = 'housing_district';

    protected $primaryKey = 'district_code';

    public $timestamps = false;

    protected $fillable = [
        'district_name',
        'hrms_district_id'
    ];
}
