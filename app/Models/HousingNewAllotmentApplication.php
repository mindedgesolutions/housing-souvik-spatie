<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingNewAllotmentApplication extends Model
{
    use HasFactory;

    protected $table = 'housing_new_allotment_application';

    protected $primaryKey = 'new_allotment_application_id';

    public $timestamps = false;

    protected $fillable = [
        'online_application_id',
        'allotment_category',
        'estate_id_choice1',
        'estate_id_choice2',
        'estate_id_choice3',
        'estate_id_choice4',
        'flat_type_id',
        'document',
        'extra_doc',
        'is_pp_sww_ph',
        'scanned_sign',
    ];

    public function housingEstate11June24Choice1()
    {
        return $this->belongsTo(HousingEstate11June24::class, 'estate_id_choice1', 'estate_id');
    }

    public function housingEstate11June24Choice2()
    {
        return $this->belongsTo(HousingEstate11June24::class, 'estate_id_choice2', 'estate_id');
    }

    public function housingEstate11June24Choice3()
    {
        return $this->belongsTo(HousingEstate11June24::class, 'estate_id_choice3', 'estate_id');
    }

    public function housingEstate11June24Choice4()
    {
        return $this->belongsTo(HousingEstate11June24::class, 'estate_id_choice4', 'estate_id');
    }

    public function housingFlatType()
    {
        return $this->belongsTo(HousingFlatType::class, 'flat_type_id', 'flat_type_id');
    }

    public function housingOnlineApplication()
    {
        return $this->belongsTo(HousingOnlineApplication::class, 'online_application_id', 'online_application_id');
    }
}
