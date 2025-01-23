<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingDistrict extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'housing_district';
    protected $primaryKey = 'district_code';
    protected $fillable = [
        'district_name',
        'hrms_district_id'
    ];
}
