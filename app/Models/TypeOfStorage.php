<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfStorage extends Model
{
    use HasFactory;

    protected $table = 'type_of_storages';
    
    protected $fillable = ['name', 'expiry_date'];

    public function storage()
    {
        return $this->hasMany(Storage::class);
    }
}
