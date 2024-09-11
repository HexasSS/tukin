<?php

// app/Models/File.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'uploaded_at',
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
