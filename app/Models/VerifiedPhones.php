<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifiedPhones extends Model
{
    use HasFactory;

    protected $table = 'verified_phones';
    protected $fillable = [
        'user_id',
        'phone',
        'code',
        'status',
    ];
}
