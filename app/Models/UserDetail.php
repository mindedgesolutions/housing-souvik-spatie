<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'users_details';

    protected $primaryKey = 'usr_dtls_id';

    protected $fillable = [
        'uid',
        'subdiv_id',
        'division_id',
        'full_name',
        'mobile_no',
        'office_phone_no'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'id');
    }
}
