<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
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
        return $this->belongsTo(college::class, 'college_id', 'id');
    }
    public function history()
    {
        return $this->hasMany(history::class, 'user_id', 'id');
    }
    public function view()
    {
        return $this->hasMany(view::class, 'userview_id', 'id');
    }
    public function favorites()
    {
        return $this->hasMany(favorites::class, 'user_id', 'id');
    }
    
    public function user_college()
    {
        return $this->hasMany(view::class, 'user_college', 'college_id');
    }

    public function requests()
{
    return $this->hasMany(requests::class, 'userId', 'id');
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
    
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\SendPasswordResetNotification($token));
    }
    
    public function RequestDeclinedNotification($editRequest)
    {
        $this->notify(new \App\Notifications\RequestDeclinedNotification($editRequest));
    }
    public function RequestApprovedNotification($editRequest)
    {
        $this->notify(new \App\Notifications\RequestApprovedNotification($editRequest));
    }

    public function sendFullTextRequestNotification($editFullRequest)
    {
        $this->notify(new \App\Notifications\FullTextRequestNotification($editFullRequest));
    }
}
