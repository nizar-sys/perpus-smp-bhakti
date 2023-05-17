<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['kode_buku', 'judul_buku', 'nama_pengarang', 'nama_penerbit', 'tahun_terbit'];

    // function boot
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->kode_buku = 'BK-' . time();
            $model->created_at = now();
        });

        self::updating(function ($model) {
            $model->updated_at = now();
        });
    }
}
