<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbaikanGedung extends Model
{
    protected $fillable = [
        'no_perbaikan',
        'nama_perbaikan', 
        'user_id', 
        'divisi_asal_id',
        'divisi_tujuan_id',
        'lantai',
        'status_perbaikan',
        'tanggal_temuan_kerusakan',
        'tanggal_batas_pengerjaan',
        'keterangan_temuan',
        'keterangan_perbaikan'];
    protected $table = 'perbaikan_gedungs';
    public $timestamps = false;

    public function divisi_asal()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function divisi_tujuan()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail_temuan_kerusakan_images()
    {
        return $this->hasMany(DetailTemuanKerusakan::class);
    }

    public function detail_perbaikan_kerusakan_images()
    {
        return $this->hasMany(DetailPerbaikanKerusakan::class);
    }
}
