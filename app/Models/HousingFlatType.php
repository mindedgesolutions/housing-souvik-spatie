<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingFlatType extends Model
{
    use HasFactory;

    protected $table = 'housing_flat_type';

    protected $primaryKey = 'flat_type_id';

    public $timestamps = false;

    protected $fillable = [
        'flat_type'
    ];
}
