<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'name',
        'order_transaction_id',
        'invoice_name',
        'user_id',
        'number',
        'total_price',
        'payment_status',
        'order_status',
        'expired_time',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('qty');
    }


}
