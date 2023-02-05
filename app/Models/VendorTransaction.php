<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorTransaction extends Model
{
    use HasFactory;

    protected $table = 'vendor_transactions';

    protected $fillable = ['laundry_vendor_id', 'laundry_id', 'status'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
