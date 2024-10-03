<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fullTextRequests extends Model
{
    protected $table = 'full_text_requests'; 
    protected $primaryKey = 'id';
    protected $fillable = ['userId','researchId','purpose','req_status','created_at','updated_at'];

    public function full_userId()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function full_researchId()
    {
        return $this->belongsTo(research::class, 'researchId', 'id');
    }
}
