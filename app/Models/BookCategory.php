<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori'
    ];

    // function boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($bookCategory) {
            $bookCategory->created_at = now();
        });

        static::updating(function ($bookCategory) {
            $bookCategory->updated_at = now();
        });
    }
}
