<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListPelajaran extends Model
{
    protected $table = 'list_pelajaran';

    protected $fillable = [
        'mata_pelajaran_id', 'guru_id', 'hari', 'waktu_mulai', 'waktu_selesai',
    ];

    public function mata_pelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }
}
