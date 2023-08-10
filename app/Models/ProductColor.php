<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $with=['Translate'];
    public function Translate()
    {
        return $this->morphMany(Translate::class, 'translatable');

    }
}
