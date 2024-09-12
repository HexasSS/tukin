<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\JuruBayar;

class File extends Model
{
    use HasFactory;

    protected $casts = [
        'uploaded_at' => 'datetime', // Ensures uploaded_at is treated as a DateTime object
    ];

    protected $fillable = [
        'file_path',
        'user_id',
        'sat_juru_bayar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function juruBayar()
    {
        return $this->belongsTo(JuruBayar::class, 'sat_juru_bayar', 'sat_juru_bayar');
    }
}
