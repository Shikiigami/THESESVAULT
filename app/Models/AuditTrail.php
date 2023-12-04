<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    protected $table = 'audit_trail'; 
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','action','changes','created_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}


