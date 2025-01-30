<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingNewApplicationEstatePreference extends Model
{
    use HasFactory;

    protected $table = 'housing_new_application_estate_preferences';

    public $timestamps = false;

    protected $fillable = [
        'online_application_id',
        'estate_id',
        'preference_order',
        'created',
    ];

    public function housingEstate11June24()
    {
        return $this->belongsTo(HousingEstate11June24::class, 'estate_id', 'estate_id');
    }

    public function housingOnlineApplication()
    {
        return $this->belongsTo(HousingOnlineApplication::class, 'online_application_id', 'online_application_id');
    }
}
