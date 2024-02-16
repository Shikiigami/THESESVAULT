<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     
    protected $fillable = [
        'name',
        'email',
        'profile_picture',
        'program',
        'college_id',
        'interest',
        'password',
        'status',
        'google_id',
        'last_login'
        
    ];
    public function college()
    {
        return $this->belongsTo(College::class, 'college_id', 'id');
    }
    public function history()
    {
        return $this->hasMany(History::class, 'user_id', 'id');
    }
    public function view()
    {
        return $this->hasMany(View::class, 'userview_id', 'id');
    }
    public function favorites()
    {
        return $this->hasMany(Favorites::class, 'user_id', 'id');
    }
    
    public function user_college()
    {
        return $this->hasMany(View::class, 'user_college', 'college_id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
