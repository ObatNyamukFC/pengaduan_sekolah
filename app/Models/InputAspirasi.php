<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    protected $table = 'input_aspirasi';
    protected $primaryKey = 'id_pelaporan';
    public $timestamps = false;

    protected $fillable = ['nis', 'id_kategori', 'lokasi', 'keterangan', 'is_anonim'];

    // Relasi: Laporan ini milik siswa siapa?
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    // Relasi: Laporan ini status/feedback-nya apa? (1 to 1)
    public function detailAspirasi()
    {
        return $this->hasOne(Aspirasi::class, 'id_pelaporan', 'id_pelaporan');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}