<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingPayBandCategory extends Model
{
    use HasFactory;

    protected $table = 'housing_pay_band_categories';

    protected $primaryKey = 'pay_band_id';

    protected $fillable = [
        'flat_type_id',
        'scale_from',
        'scale_to',
    ];

    public function flatType()
    {
        return $this->hasOne(HousingFlatType::class, 'flat_type_id', 'flat_type_id');
    }

    public function housingFlat()
    {
        return $this->hasOne(HousingFlat::class, 'flat_type_id', 'flat_type_id');
    }
}
