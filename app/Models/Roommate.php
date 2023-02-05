<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roommate extends Model
{
    use HasFactory;

    protected $table = 'roommates';

    protected $fillable = [
        'user_id',
        'requested_user_id',
        'class_id',
        'room_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
