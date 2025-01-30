<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingEstate11June24 extends Model
{
    use HasFactory;

    protected $table = 'housing_estate_11_june_24';

    protected $primaryKey = 'estate_id';

    public $timestamps = false;

    protected $fillable = [
        'district_code',
        'estate_type_id',
        'estate_name',
        'estate_address',
        'circle_id',
        'division_id',
        'subdiv_id',
        'estate_pincode'
    ];
}
