<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $table = 'auditLog'; 
    protected $primaryKey = 'id';
    protected $fillable = ['adminId', 'admin_action', 'research', 'action_date'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'adminId', 'id');
    }
}
