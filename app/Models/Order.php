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
        'user_id',
        'number',
        'total_price',
        'payment_status',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('qty');
    }


}
