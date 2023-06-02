<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string, mixed>
     */
    protected $fillable = [
        'user_id',
        'nis',
        'nama_anggota',
        'alamat',
        'no_telp',
        'tgl_lahir',
    ];

    protected $appends = [
        'isVisited'
    ];

    // function boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = now();
        });

        static::updating(function ($model) {
            $model->updated_at = now();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function visitor()
    {
        return $this->hasOne(Visitor::class, 'anggota_id', 'id');
    }

    public function getIsVisitedAttribute()
    {
        return $this->visitor()->exists();
    }
}
