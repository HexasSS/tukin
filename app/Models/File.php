<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\JuruBayar;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'user_id',
        'sat_juru_bayar',
        'uploaded_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($file) {
            $file->user_id = Auth::id();
        });
    }

    // Add relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function juruBayar()
    {
        return $this->belongsTo(JuruBayar::class, 'sat_juru_bayar', 'sat_juru_bayar');
    }
}
