<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requests extends Model
{
    protected $table = 'requests'; 
    protected $primaryKey = 'id';
    protected $fillable = ['userId','researchId','purpose','req_status','receive_thru','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function research()
    {
        return $this->belongsTo(research::class, 'researchId', 'id');
    }

}
