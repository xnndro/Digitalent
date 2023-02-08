<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;

    protected $table = 'complains';

    protected $fillable = ['complain_id','user_id','complain_type','transaction_id','fotoBarang','complain_name','description','jumlahBarang','status', 'user_room'];

}
