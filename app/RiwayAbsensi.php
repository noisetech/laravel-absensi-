<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayAbsensi extends Model
{
    protected $table = 'riwayat_absensi';

    protected $fillable = [
        'jadwal_siswa_id', 'tanggal'
    ];

    public function jadwal_siswa()
    {
        return $this->belongsTo(JadwalSiswa::class, 'jadwal_siswa_id', 'id');
    }
}
