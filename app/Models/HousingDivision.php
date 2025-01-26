<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingDivision extends Model
{
    use HasFactory;

    protected $table = 'housing_division';

    protected $primaryKey = 'division_id';

    protected $fillable = ['division_name', 'circle_id'];

    public function housingCicle()
    {
        return $this->belongsTo(HousingCircle::class, 'circle_id', 'circle_id');
    }
}
