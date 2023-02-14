<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;

    protected $table = 'laundries';

    protected $fillable = ['laundry_transaction_id','user_id', 'total_pcs', 'total_kg', 'laundry_vendor_id', 'tanggalVendor','tanggalMasuk','tanggalAmbil','tanggalMaxComplain', 'status','laundry_type_id','total_price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laundryVendor()
    {
        return $this->hasMany(LaundryVendor::class);
    }
}
