<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    protected $table = 'history'; 
    protected $primaryKey = 'hid';
    protected $fillable = ['search_name','user_id','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}

