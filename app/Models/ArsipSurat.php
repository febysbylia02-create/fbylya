<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
    use HasFactory;
    
    protected $table = 'arsip_surat';
    
    protected $fillable = [
        'tanggal_arsip',
        'file_path',
        'catatan',
    ];
    
    /**
     * Satu arsip surat bisa digunakan oleh banyak surat keluar
     * Relasi: One to Many
     */
    public function suratKeluar()
    {
        // UBAH dari hasOne menjadi hasMany
        return $this->hasMany(SuratKeluar::class, 'arsip_surat_id');
    }
}