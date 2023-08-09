<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebLangDetail extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function Language(){
        return $this->belongsTo(Language::class,'language_id','id');
    }
}
