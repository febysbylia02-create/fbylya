<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;
    
    protected $table = 'surat_keluar';
    
    protected $fillable = [
        'nomor_urut',
        'nomor_berkas',
        'alamat_penerima',
        'tanggal_surat',
        'perihal',
        'nomor_petunjuk',
        'arsip_surat_id',
        'nomor_paket',
        'file_path',
    ];
    
    /**
     * Setiap surat keluar belongs to satu arsip surat
     * Relasi: Many to One (inverse dari hasMany)
     */
    public function arsipSurat()
    {
        // UBAH dari hasOne menjadi belongsTo
        return $this->belongsTo(ArsipSurat::class, 'arsip_surat_id');
    }
}