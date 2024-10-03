<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class college extends Model
{
    protected $table = 'college'; 
    protected $primaryKey = 'id';
    protected $fillable = ['college_name'];

    public function research()
{
    return $this->hasMany(research::class, 'college', 'id');
}
public function users()
    {
        return $this->hasMany(User::class, 'college_id', 'id');
    }
    
}
