<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'kelas', 'wali_kelas_id'
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'wali_kelas_id', 'id');
    }

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'siswa_kelas', 'siswa_id', 'kelas_id');
    }
}
