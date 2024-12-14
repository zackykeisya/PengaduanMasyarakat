<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'provinsi', 'regency', 'subdistrict', 'description', 'image', 'viewers', 'votes'
    ];
    
    
    


 // Relasi dengan Komentar
 public function user()
{
    return $this->belongsTo(User::class);
}

}

