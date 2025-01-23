<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingEstate extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'housing_estate';
    protected $primaryKey = 'housing_estate_id';
}
