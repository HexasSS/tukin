<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'pangkat';

    // Specify the primary key (optional if it is 'id')
    protected $primaryKey = 'id';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'NamaPangkat',
        'PktPers',
        'Jpns',
    ];

    // Disable timestamps if you don't want to use created_at and updated_at
    public $timestamps = true;
}
