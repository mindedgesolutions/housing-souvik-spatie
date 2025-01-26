<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingEstate extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'housing_estate';

    protected $primaryKey = 'estate_id';

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

    public function housingCircle()
    {
        return $this->belongsTo(HousingCircle::class, 'circle_id', 'circle_id');
    }

    public function housingDistrict()
    {
        return $this->belongsTo(HousingDistrict::class, 'district_code', 'district_code');
    }

    public function housingFlat()
    {
        return $this->hasMany(HousingFlat::class, 'estate_id', 'estate_id');
    }

    public function housingTreasuryEstateMapping()
    {
        return $this->belongsTo(HousingTreasuryEstateMapping::class, 'estate_id', 'estate_id');
    }
}
