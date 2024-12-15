<?php
// app/Models/Komentar.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengaduan_id', 'comment'
    ];

    // Relasi dengan Pengaduan
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
