<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingFlat extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'housing_flat';

    protected $primaryKey = 'flat_id';

    protected $fillable = [
        'estate_id',
        'block_id',
        'floor',
        'flat_type_id',
        'flat_no',
        'flat_status_id',
        'flat_category_id',
        'remarks'
    ];

    public function housingEstate()
    {
        return $this->belongsTo(HousingEstate::class, 'estate_id', 'estate_id');
    }

    public function housingFlatType()
    {
        return $this->hasOne(HousingFlatType::class, 'flat_type_id', 'flat_type_id');
    }

    public function housingPayBandCategory()
    {
        return $this->hasOne(HousingPayBandCategory::class, 'flat_type_id', 'flat_type_id');
    }
}
