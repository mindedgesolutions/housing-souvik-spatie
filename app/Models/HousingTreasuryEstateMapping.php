<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingTreasuryEstateMapping extends Model
{
    use HasFactory;

    protected $table = 'housing_treasury_estate_mapping';

    protected $primmaryKey = 'housing_treasury_estate_mapping_id';

    protected $fillable = [
        'treasury_id',
        'estate_id',
        'is_active'
    ];
}
