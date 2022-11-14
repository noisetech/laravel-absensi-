<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Siswa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiswaController extends Controller
{
    public function index()
    {
        $items = Siswa::with(['user'])->get();

        return view('pages.siswa.index', [
            'items' => $items
        ]);
    }

    public function tambah()
    {
        return view('pages.siswa.create');
    }



    public function simpan(Request $request)
    {

        $data = $request->all();

        $foto_siswa = $request->file('foto');
        $path_foto_siswa = public_path() . '/foto-siswa';
        if (!File::exists($path_foto_siswa)) {
            File::makeDirectory($path_foto_siswa, $mode = 0777, true, true);
        }
        $nama_foto =  'foto-siswa' . md5(rand()) . uniqid() .
            time() . date('ymd') . '.' . $foto_siswa->getClientOriginalExtension();

        $foto_siswa->move($path_foto_siswa, $nama_foto);

        $data['foto'] = $nama_foto;

        Siswa::create($data);

        return redirect()->route('siswa');
    }

    public function listuser(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = User::select("id", "email")
                ->Where('email', 'LIKE', "%$search%")
                ->Where('role_id', '3')
                ->get();
        } else {
            $data = User::where('role_id', '3');
        }

        // dd($data);
        return response()->json($data);
    }

    public function edit($id)
    {
        $item = Siswa::find($id);

        return view('pages.siswa.edit', [
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->hasFile('foto')) {
            $foto_siswa = $request->file('foto');
            $path_foto_siswa = public_path() . '/foto-siswa';
            if (!File::exists($path_foto_siswa)) {
                File::makeDirectory($path_foto_siswa, $mode = 0777, true, true);
            }
            $nama_foto =  'foto-siswa' . md5(rand()) . uniqid() .
                time() . date('ymd') . '.' . $foto_siswa->getClientOriginalExtension();

            $foto_siswa->move($path_foto_siswa, $nama_foto);

            $siswa = Siswa::find($id);
            $siswa->user_id = $request->user_id;
            $siswa->nama = $request->nama;
            $siswa->jk = $request->jk;
            $siswa->tanggal_lahir = $request->tanggal_lahir;
            $siswa->tempat_lahir = $request->tempat_lahir;
            $siswa->alamat = $request->alamat;
            $siswa->foto = $nama_foto;
            $siswa->nama_wali = $request->nama_wali;
            $siswa->save();
        }

        $siswa = Siswa::find($id);
        $siswa->user_id = $request->user_id;
        $siswa->nama = $request->nama;
        $siswa->jk = $request->jk;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->tempat_lahir = $request->tempat_lahir;
        $siswa->alamat = $request->alamat;
        $siswa->nama_wali = $request->nama_wali;
        $siswa->save();

        return redirect()->route('siswa');
    }


    public function hapus($id)
    {
        $item = Siswa::find($id);

        $item->delete();

        return redirect()->route('siswa');
    }

    public function listuserSiswa(Request $request, $id)
    {
        $siswa = Siswa::where('id', $id)->first();

        $data = User::find($siswa->user_id);

        return response()->json(['user' => json_decode($data)]);
    }

    public function tambah_kelas_siswa($id)
    {
        $siswa = Siswa::find($id);

        return view('pages.siswa.tambah-kelas', [
            'siswa' => $siswa
        ]);
    }


    public function listkelas(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Kelas::select("id", "kelas")
                ->Where('kelas', 'LIKE', "%$search%")
                ->get();
        } else {
            $data = Kelas::all();
        }

        // dd($data);
        return response()->json($data);
    }

    public function simpan_kelas_siswa(Request $request)
    {
        $siswa = Siswa::find($request->siswa_id);

        $siswa->kelas()->attach($request->kelas_id);

        return redirect()->route('siswa');
    }
}
