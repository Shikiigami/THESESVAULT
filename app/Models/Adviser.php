<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adviser extends Model
{
    protected $table = 'adviser'; 
    protected $primaryKey = 'adviserId';
    protected $fillable = ['adviser_name', 'adviser_college','profile_picture'];


    public function college_aid()
    {
        return $this->belongsTo(college::class, 'adviser_college', 'id');
    }
    public function adviser()
    {
        return $this->hasMany(research::class, 'adviser', 'adviser_name');
    }
}

