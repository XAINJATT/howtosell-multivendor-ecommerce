<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded=[];

    public function Parent(){
       return $this->belongsTo(Category::class, 'parent_id','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

//    public function getNameAttribute($key)
//    {
//        $locale = app()->getLocale();
//        $text_type = $locale.'_text';
//        $q = $this->Translate()->where('key','name')->first();
//        if ($q){
//            return $q[$text_type];
//        }else{
//            return $this->attributes['name'];
//        }
//    }
}
