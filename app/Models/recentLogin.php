<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recentLogin extends Model
{
    protected $table = 'recent_login'; 
    protected $primaryKey = 'id';
    protected $fillable = ['idUser','login_time', 'created_at', 'updated_at'];

    public function userLogin()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
}
