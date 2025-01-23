<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingFlatStatus extends Model
{
    use HasFactory;
    protected $table = 'housing_flat_status';
    protected $primaryKey = 'flat_status_id';
    protected $fillable = [
        'flat_status','availability','is_occupied','flat_status_code','is_active'
    ];
}
