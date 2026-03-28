<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable; // BUKAN Model biasa

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'username'; // Sesuai ERD
    public $incrementing = false;    
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['username', 'password'];
    protected $hidden = ['password'];
}