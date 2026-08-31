<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worksheet extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal',
        'jenis_pekerjaan',
        'keterangan_pekerjaan',
        'perkiraan_pekerjaan',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
