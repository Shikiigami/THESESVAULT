<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $table = 'download'; 
    protected $primaryKey = 'did';
    protected $fillable = ['user_did','dl_filename','created_at', 'updated_at'];

    public function userdownload()
    {
        return $this->belongsTo(User::class, 'user_did', 'id');
    }

    public function dl_filename()
    {
        return $this->belongsTo(Research::class, 'dl_filename', 'filename');
    }
}
