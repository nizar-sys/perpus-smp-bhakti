<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['book_category_id','kode_buku', 'judul_buku', 'nama_pengarang', 'nama_penerbit', 'tahun_terbit', 'jumlah_buku', 'available'];

    protected $appends = [
        'available_text'
    ];

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

    function getAvailableTextAttribute()
    {
        return $this->available == 'y' ? 'Tersedia' : 'Tidak Tersedia';
    }

    function category()
    {
        return $this->belongsTo(BookCategory::class, 'book_category_id', 'id');
    }
}
