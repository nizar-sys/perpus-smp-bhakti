<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    use HasFactory;

    protected $fillable = [
        'buku_id',
        'tanggal',
        'keterangan',
        'jumlah_buku',
    ];

    public function buku()
    {
        return $this->belongsTo(Book::class);
    }

    // function boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->tanggal = now();
            $model->created_at = now();
        });

        static::updating(function ($model) {
            $model->updated_at = now();
        });
    }

    public function selisihBuku(): Attribute
    {
        return Attribute::make(
            function () {
                return $this->buku->jumlah_buku - $this->jumlah_buku;
            }
        );
    }
}
