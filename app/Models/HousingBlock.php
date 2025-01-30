<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingBlock extends Model
{
    use HasFactory;

    protected $table = 'housing_block';

    protected $primaryKey = 'block_id';

    public $timestamps = false;
}
