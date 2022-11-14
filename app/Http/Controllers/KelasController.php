<?php

namespace App\Http\Controllers;

use App\Guru;
use App\JadwalSiswa;
use App\Kelas;
use App\ListPelajaran;
use App\RiwayAbsensi;
use App\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function index()
    {
        $user_login = Auth::user()->id;

        $bahan_guru = Guru::where('user_id', $user_login)->first();

        if (Auth::user()->role->role == 'admin') {
            $items = Kelas::with(['guru'])->get();

            return view('pages.kelas.index', [
                'items' => $items
            ]);
        } elseif (Auth::user()->role->role == 'guru') {
            $items = Kelas::with(['guru'])->where('wali_kelas_id', $bahan_guru->id)->get();

            return view('pages.kelas.index', [
                'items' => $items
            ]);
        }
    }

    public function tambah()
    {
        return view('pages.kelas.create');
    }




    public function listguru(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Guru::select("id", "nama")
                ->Where('nama', 'LIKE', "%$search%")
                ->get();
        } else {
            $data = Guru::all();
        }

        // dd($data);
        return response()->json($data);
    }


    public function simpan(Request $request)
    {

        $this->validate($request, [
            'kelas' => 'required',
            'wali_kelas_id' => 'required|unique:kelas,wali_kelas_id'
        ], [
            'kelas.required' => 'tidak boleh kosong',
            'wali_kelas_id.required' => 'tidak boleh kosong',
            'wali_kelas.unique' => 'pilih wali kelas yang lain',
        ]);

        $kelas = new Kelas();
        $kelas->kelas = $request->kelas;
        $kelas->wali_kelas_id = $request->wali_kelas_id;
        $kelas->save();

        return redirect()->route('kelas');
    }


    public function hapus($id)
    {
        $item = Kelas::find($id);

        $item->delete();


        return redirect()->route('kelas');
    }

    public function list_siswa($id)
    {
        $kelas_id = $id;
        $list_siswa  = Siswa::whereHas('kelas', function ($q) use ($kelas_id) {
            return $q->where('siswa_kelas.kelas_id', $kelas_id);
        })->get();

        return view('pages.kelas.list-siswa', [
            'list_siswa' => $list_siswa
        ]);
    }

    public function input_jadwal_siswa($id)
    {
        $siswa = Siswa::find($id);
        $items = ListPelajaran::all();

        return view('pages.kelas.list-pelarajan', [
            'siswa' => $siswa,
            'items' => $items,
        ]);
    }

    public function simpan_jadwal_siswa(Request $request)
    {
        $data = $request->all();

        foreach ($data['list_pelajaran'] as $key => $value) {
            $jadwal_siswa = new JadwalSiswa();
            $jadwal_siswa->siswa_id = $request->siswa_id;
            $jadwal_siswa->list_pelajaran_id = $data['list_pelajaran'][$key];
            $jadwal_siswa->save();
        }


        $siswa_id = $request->siswa_id;


        $bahan_kelas_siswa = Siswa::with('kelas')->where('id', $siswa_id)->first();


        foreach ($bahan_kelas_siswa->kelas as $kelas) {
            $data_kelas = $kelas->id;
        }




        return redirect()->route('list-siswa.kelasById', $data_kelas);
    }

    public function lihat_jadwal_siswa($id)
    {
        $jadwal_siswa = JadwalSiswa::whereHas('siswa', function ($q) use ($id) {
            return $q->where('siswa_id', $id);
        })->get();


        return view('pages.kelas.jadwal-siswa', [
            'jadwal_siswa' => $jadwal_siswa,
        ]);
    }

    public function absensi(Request $request)
    {

        // dd($request->all());
        $jadwal_siswa = JadwalSiswa::find($request->jadwal_siswa_id);

        $absen = $jadwal_siswa->jumlah_absen  + 1;

        $jadwal_siswa->update([
            'jumlah_absen' =>  $absen
        ]);

        $riwayat_absensi = new RiwayAbsensi();
        $riwayat_absensi->jadwal_siswa_id = $jadwal_siswa->id;
        $riwayat_absensi->tangal_absensi = Carbon::now();
        $riwayat_absensi->save();

        return redirect()->route('lihat-jadwal-siswa', $jadwal_siswa->siswa_id);
    }
}
