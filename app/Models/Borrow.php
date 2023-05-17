<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'buku_id',
        'peminjam_id',
        'petugas_id',
        'tanggal_pinjam',
        'status',
    ];

    public function buku()
    {
        return $this->belongsTo(Book::class, 'buku_id', 'id');
    }

    public function peminjam()
    {
        return $this->belongsTo(Anggota::class, 'peminjam_id', 'id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id', 'id');
    }

    // function boot
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->petugas_id = auth()->user()->id;
            $model->created_at = now();
        });

        self::updating(function ($model) {
            $model->petugas_id = auth()->user()->id;
            $model->updated_at = now();
        });
    }

    public function statusFormated(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->status == 'dipinjam' ? "Belum dikembalikan" : "Sudah dikembalikan",
        );
    }
}
