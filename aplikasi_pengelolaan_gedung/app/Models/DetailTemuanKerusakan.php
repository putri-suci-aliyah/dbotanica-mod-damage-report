<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTemuanKerusakan extends Model
{
    protected $fillable = [
        'perbaikan_gedung_id',
        'file_path',
    ];

    protected $table = 'detail_temuan_kerusakans';
    public $timestamps = false;
    public function perbaikan()
    {
        return $this->belongsTo(PerbaikanGedung::class);
    }
}
