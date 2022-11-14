<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalSiswa extends Model
{
    protected $table = 'jadwal_siswa';

    protected $fillable = [
        'siswa_id', 'list_pelajaran_id', 'jumlah_absen'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function list_pelajaran()
    {
        return $this->belongsTo(ListPelajaran::class, 'list_pelajaran_id', 'id');
    }

    public function riwayat_absensi()
    {
        return $this->hasMany(RiwayAbsensi::class, 'jadwal_siswa_id');
    }
}
