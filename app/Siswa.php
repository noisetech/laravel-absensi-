<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'user_id', 'nama', 'tanggal_lahir', 'tempat_lahir', 'alamat', 'nama_wali', 'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'siswa_kelas', 'siswa_id', 'kelas_id');
    }
}
