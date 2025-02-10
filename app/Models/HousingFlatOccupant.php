<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingFlatOccupant extends Model
{
    use HasFactory;

    protected $table = 'housing_flat_occupant';

    protected $primaryKey = 'flat_occupant_id';

    protected $fillable = [
        'online_application_id',
        'allotment_date',
        'release_date',
        'flat_id',
        'housing_existing_flat_occupant_id',
        'allotment_no',
        'accept_reject_status',
        'allotment_process_no',
        'roaster_vacancy_position',
        'allotment_reason',
        'allowed_for_floor_shifting',
        'allotment_approve_or_reject_date',
        'cancellation_extension_status',
        'cancellation_extension_date',
    ];

    public function housingFlat()
    {
        return $this->belongsTo(HousingFlat::class, 'flat_id', 'flat_id');
    }
}
