<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $with=['Translate'];
    public function Translate()
    {
        return $this->morphMany(Translate::class, 'translatable');

    }

    public function getDetailsAttribute($key)
    {
        $locale = app()->getLocale();
        $text_type = $locale.'_text';
        $q = $this->Translate()->where('key','details')->first();
        if ($q){
            return $q[$text_type];
        }else{
            return $this->attributes['details'];
        }
    }

    public function getDescriptionAttribute($key)
    {
        $locale = app()->getLocale();
        $text_type = $locale.'_text';
        $q = $this->Translate()->where('key','description')->first();
        if ($q){
            return $q[$text_type];
        }else{
            return $this->attributes['description'];
        }
    }
}
