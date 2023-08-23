<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'status',
        'online_status',
        'device_token',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id','id');
    }

    public function profiles()
    {
        return $this->hasOne(Profile::class, 'user_id','id')
            ->where('first_name', '!=', null)
            ->where('last_name', '!=', null);
    }
    public function wallet()
    {
        return $this->hasOne(Wallet::class,'user_id','id');
    }
}
