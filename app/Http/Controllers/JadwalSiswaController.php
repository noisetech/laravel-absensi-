<?php

namespace App\Http\Controllers;

use App\JadwalSiswa;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalSiswaController extends Controller
{
    public function index()
    {
        $user_login = Auth::user()->id;

        $bahan_siswa = Siswa::where('user_id', $user_login)->first();

        $jadwal_siswa = JadwalSiswa::whereHas('siswa', function ($q) use ($bahan_siswa) {
            return $q->where('siswa_id', $bahan_siswa->id);
        })->get();

        // dd($jadwal_siswa);

        return view('pages.jadwal-siswa-by-login-siswa.index', [
            'jadwal_siswa' => $jadwal_siswa
        ]);
    }
}
