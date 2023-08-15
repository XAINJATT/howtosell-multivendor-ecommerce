<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function Size(){
        return $this->belongsTo(Size::class, 'size_id','id');
    }
}
