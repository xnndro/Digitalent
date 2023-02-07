<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    use HasFactory;
    protected $table = 'financials';
    protected $fillable = [
        'user_id',
        'name',
        'transaction_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
