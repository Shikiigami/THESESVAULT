<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class view extends Model
{
    protected $table = 'view'; 
    protected $primaryKey = 'vid';
    protected $fillable = ['research_id','filename','userview_id','viewed_at', 'created_at', 'updated_at'];

    public function researchId()
    {
        return $this->belongsTo(research::class, 'research_id', 'id');
    }

    public function filename()
    {
        return $this->belongsTo(research::class, 'filename', 'filename');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'userview_id', 'id');
    }
    public function research_college()
    {
        return $this->belongsTo(research::class, 'research_college', 'college');
    }
    public function user_college()
    {
        return $this->belongsTo(User::class, 'user_college', 'college_id');
    }

}
