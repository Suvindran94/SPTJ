<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
      protected $table = 'login_logs';

    protected $fillable = [
'id', 'user_id', 'email', 'event', 'ip_address', 'user_agent', 'created_at', 'updated_at'
    ];

    // Relationship to Doctor
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
