<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrow_id',
        'petugas_id',
        'tanggal_kembali',
        'denda',
        'jumlah_denda',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Borrow::class, 'borrow_id', 'id');
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
            $model->created_at = now();
        });

        self::updating(function ($model) {
            $model->updated_at = now();
        });
    }

    function jumlahDendaFormated(): Attribute
    {
        return Attribute::make(
            get: fn() => "Rp. " . number_format($this->jumlah_denda, 0, ',', '.'),
        );
    }
}
