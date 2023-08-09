<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $with=['Translate'];
    public function Translate()
    {
        return $this->morphMany(Translate::class, 'translatable');

    }

    public function Parent(){
       return $this->belongsTo(Category::class, 'parent_id','id');
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
