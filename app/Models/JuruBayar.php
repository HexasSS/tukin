<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class JuruBayar extends Model
{
    use HasFactory;

    // Declare the custom primary key if it's not 'id'
    protected $primaryKey = 'sat_juru_bayar';

    // If the primary key is not an auto-incrementing integer, specify this
    public $incrementing = false;
    protected $keyType = 'string';

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
    public function files()
    {
        return $this->hasMany(File::class, 'sat_juru_bayar', 'sat_juru_bayar');
    }
}
