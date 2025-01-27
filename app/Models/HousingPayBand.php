<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingPayBand extends Model
{
    use HasFactory;

    protected $table = 'housing_pay_band';

    protected $primaryKey = 'pay_band_id';

    protected $fillable = [
        'payband',
        'scale_from',
        'scale_to',
        'flat_type_id',
        'grade_pay_from',
        'grade_pay_to',
    ];

    public function housingFlatType()
    {
        return $this->hasOne(HousingFlatType::class, 'flat_type_id', 'flat_type_id');
    }
}
