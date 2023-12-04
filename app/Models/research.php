<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class research extends Model
{
    protected $table = 'research'; 
    protected $primaryKey = 'id';
    protected $fillable = ['callno','filename','author','college','adviser','date_published','fieldname','campus','citation','drive_link'];

    public function college()
    {
        return $this->belongsTo(College::class, 'college', 'id');
    }
    public function view()
    {
        return $this->hasMany(View::class, 'filename', 'filename');
    }
    public function researchView()
    {
        return $this->hasMany(View::class, 'id', 'research_id');
    }
    
    public function filename()
    {
        return $this->hasMany(View::class, 'filename', 'filename');
    }
    public function adviserName()
    {
        return $this->belongsTo(Adviser::class, 'adviser', 'adviser_name');
    }
    public function dl_filename()
    {
        return $this->hasMany(Download::class, 'filename', 'dl_filename');
    }

    public function research_college()
    {
        return $this->hasMany(View::class, 'research_college', 'college');
    }
}
