<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'aspirasi';
    protected $primaryKey = 'id_aspirasi';
    public $timestamps = false;

    protected $fillable = ['id_pelaporan', 'status', 'feedback'];
}