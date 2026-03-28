<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['nis', 'kelas'];
    
    public function inputAspirasi() {
        return $this->hasMany(InputAspirasi::class, 'nis', 'nis');
    }
}