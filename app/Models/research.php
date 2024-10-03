<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class research extends Model
{
    protected $table = 'research'; 
    protected $primaryKey = 'id';
    protected $fillable = ['callno','filename','author','college','adviser','date_published','fieldname','campus','citation','drive_link','approvalSheet','abstract'];

    public function college()
    {
        return $this->belongsTo(college::class, 'college', 'id');
    }
    public function view()
    {
        return $this->hasMany(view::class, 'filename', 'filename');
    }
    public function researchView()
    {
        return $this->hasMany(view::class, 'id', 'research_id');
    }
    
    public function filename()
    {
        return $this->hasMany(view::class, 'filename', 'filename');
    }
    public function adviserName()
    {
        return $this->belongsTo(Adviser::class, 'adviser', 'adviser_name');
    }

    public function research_college()
    {
        return $this->hasMany(view::class, 'research_college', 'college');
    }
    public function views()
{
    return $this->hasMany(view::class, 'filename', 'filename');
}

public function requests()
{
    return $this->hasMany(requests::class, 'reseachId', 'id');
}

}
