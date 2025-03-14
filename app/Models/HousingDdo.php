<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingDdo extends Model
{
    use HasFactory;

    protected $table = 'housing_ddo';

    protected $primaryKey = 'ddo_id';

    public $timestamps = false;

    protected $fillable = [
        'ddo_id',
        'treasury_id',
        'district_code',
        'ddo_designation',
        'ddo_address',
        'ddo_code',
        'is_active',
        'ddo_type_id'
    ];

    public function HousingDistrict()
    {
        return $this->hasOne(HousingDistrict::class, 'district_code', 'district_code');
    }
}
