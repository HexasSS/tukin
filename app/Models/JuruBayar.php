<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuruBayar extends Model
{
    use HasFactory;

    protected $fillable = [
        'sat_juru_bayar',
        'nama_sat_juru_bayar',
        'pekas',
        'satker',
        'anak_satker',
        'kd_satker',
    ];

    /**
     * Get the users for the JuruBayar.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'sat_juru_bayar_id');
    }
}
