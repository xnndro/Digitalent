<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryVendor extends Model
{
    use HasFactory;

    protected $table = 'laundry_vendors';

    protected $fillable = ['name'];

    public function laundry()
    {
        return $this->belongsTo(Laundry::class);
    }
}
