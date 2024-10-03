<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorites extends Model
{
    protected $table = 'favorites'; 
    protected $primaryKey = 'fid';
    protected $fillable = ['user_id','research_id','filename','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function filename()
    {
        return $this->belongsTo(research::class, 'filename', 'filename');
    }
    
    public function research()
    {
        return $this->belongsTo(research::class, 'researh_id', 'id');
    }
}
