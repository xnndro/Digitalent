<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'name',
        'lantai',
        'gender',
        'status',
    ];

    public function roommates()
    {
        return $this->hasMany(Roommate::class);
    }
}
