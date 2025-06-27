<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bilik extends Model
{
      protected $table = 'bilik';

    protected $fillable = [
        'nama_bilik',
        'jenis_rawatan',
        'doktor_id',
        'status',
        'keterangan' // Add this if you're including token in mass assignment
    ];

    // Relationship to Doctor
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doktor_id');
    }
}