<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tokens extends Model
{
    protected $table = 'tokens'; 
    protected $primaryKey = 'id';
    protected $fillable = ['request_id','email','token','created_at','updated_at'];

    public function request()
    {
        return $this->belongsTo(fullTextRequests::class, 'request_id', 'id');
    }
}
