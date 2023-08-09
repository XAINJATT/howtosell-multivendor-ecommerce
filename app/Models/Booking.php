<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function Vendor(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function Product(){
        return $this->belongsTo(Product::class, 'product_id','id');
    }
    public function User(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
