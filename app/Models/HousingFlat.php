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

    public function getHousingEstate(): BelongsTo
    {
        return $this->belongsTo(getHousingEstate::class, 'estate_id', 'estate_id');
    }

    //$response->district->district_name
}
