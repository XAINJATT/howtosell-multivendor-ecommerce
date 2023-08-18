<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\FavoriteProduct;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function ProductCategory(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }

    public function ProductColors(){
        return $this->hasMany(ProductColor::class,'product_id','id');
    }

    public function ProductSizes(){
        return $this->hasMany(ProductSize::class,'product_id','id');
    }

    public function ProductImages(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }

    public function isFavorite($userId = null) {
        $userId = $userId ?: Auth::id(); // Get the authenticated user's ID if not provided

        // Check if the product is favorited by the user
        return FavoriteProduct::where('user_id', $userId)
            ->where('product_id', $this->id)
            ->exists();
    }

    // public function ProductOffers(){
    //     return $this->hasMany(ProductOffer::class,'product_id','id');
    // }
    // public function Country(){
    //     return $this->belongsTo(Country::class, 'country_id','id');
    // }



//
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
//    public function getShortDescriptionAttribute($key)
//    {
//        $locale = app()->getLocale();
//        $text_type = $locale.'_text';
//        $q = $this->Translate()->where('key','short_description')->first();
//        if ($q){
//            return $q[$text_type];
//        }else{
//            return $this->attributes['short_description'];
//        }
//    }
//    public function getLongDescriptionAttribute($key)
//    {
//        $locale = app()->getLocale();
//        $text_type = $locale.'_text';
//        $q = $this->Translate()->where('key','long_description')->first();
//        if ($q){
//            return $q[$text_type];
//        }else{
//            return $this->attributes['long_description'];
//        }
//    }
}
