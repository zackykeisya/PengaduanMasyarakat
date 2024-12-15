<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans'; // Pastikan ini sesuai dengan nama tabel Anda

    protected $fillable = [
        'type', 'subdistrict', 'regency', 'provinsi', 'description', 'image', 'viewers', 'votes'
    ];

 
    
    


 // Relasi dengan Komentar
public function komentars()
{
    return $this->hasMany(Komentar::class);
}


}

