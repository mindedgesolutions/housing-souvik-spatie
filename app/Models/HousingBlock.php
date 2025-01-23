<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingBlock extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'housing_block';
    protected $primaryKey = 'block_id';
}
