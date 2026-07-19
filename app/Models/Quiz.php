<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'judul',
        'kategori',
        'jumlah_soal',
        'pembuat',
        'status',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}