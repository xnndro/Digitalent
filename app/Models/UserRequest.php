<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;
    protected $table = 'user_requests';
    protected $fillable = [
        'user_id',
        'requested_user_id',
        'class_id',
        'status',
    ];


}
