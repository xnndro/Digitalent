<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    protected $table = 'storages';
    protected $fillable = ['namaBarang','typeOfStorage_id', 'lantai', 'tanggalMasuk', 'tanggalKeluar', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function typeOfStorage()
    {
        return $this->belongsTo(TypeOfStorage::class);
    }
}
