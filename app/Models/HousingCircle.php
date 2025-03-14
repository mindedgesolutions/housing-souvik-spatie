<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingCircle extends Model
{
    use HasFactory;

    protected $table = 'housing_circle';

    protected $primaryKey = 'circle_id';

    public $timestamps = false;

    protected $fillable = ['circle_name'];
}
