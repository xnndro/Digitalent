<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryType extends Model
{
    use HasFactory;

    protected $table = 'laundry_types';

    protected $fillable = ['name', 'price', 'minimal_unit'];

    public function laundry()
    {
        return $this->hasMany(Laundry::class);
    }
}
