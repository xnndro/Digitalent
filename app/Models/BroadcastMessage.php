<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BroadcastMessage extends Model
{
    use HasFactory;

    protected $table = 'broadcast_messages';

    protected $fillable = ['title', 'message','status','tanggal'];
}
