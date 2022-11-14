<?php

namespace App\Http\Controllers;

use App\Guru;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    public function index()
    {
        $items = Guru::with(['user'])->get();

        return view('pages.guru.index', [
            'items' => $items
        ]);
    }

    public function tambah()
    {
        return view('pages.guru.create');
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'user_id' => 'required'
        ], [
            'nama.required' => 'tidak boleh kosong',
            'telp.required' => 'tidak boleh kosong',
            'alamat.required' => 'tidak boleh kosong',
            'foto.required' => 'tidak boleh kosong',
            'user_id.required' => 'tidak boleh kosong'
        ]);

        if ($request->hasFile('foto')) {
            $foto_guru = $request->file('foto');
            $path_foto_guru = public_path() . '/foto-guru';
            if (!File::exists($path_foto_guru)) {
                File::makeDirectory($path_foto_guru, $mode = 0777, true, true);
            }
            $nama_foto =  'foto-guru' . md5(rand()) . uniqid() .
                time() . date('ymd') . '.' . $foto_guru->getClientOriginalExtension();

            $foto_guru->move($path_foto_guru, $nama_foto);


            $guru = new Guru();
            $guru->nama = $request->nama;
            $guru->telp = $request->telp;
            $guru->alamat = $request->alamat;
            $guru->foto = $nama_foto;
            $guru->user_id = $request->user_id;
            $guru->save();

            return redirect()->route('guru')->with('status', 'Data berhasil ditambah');
        }
    }

    public function ubah($id)
    {
        $item = Guru::with(['user'])->find($id);

        return view('pages.guru.edit', [
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'nama' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'user_id' => 'required'
        ], [
            'nama.required' => 'tidak boleh kosong',
            'telp.required' => 'tidak boleh kosong',
            'alamat.required' => 'tidak boleh kosong',
            'foto.image' => 'harus berupa gambar',
            'foto.mimes' => 'harus png,jpg,jpeg',
            'foto.max' => 'maximal 2 MB',
            'user_id.required' => 'tidak boleh kosong'
        ]);


        if ($request->hasFile('foto')) {

            $path_foto_guru = public_path() . '/foto-guru';
            if (!File::exists($path_foto_guru)) {
                File::makeDirectory($path_foto_guru, $mode = 0777, true, true);
            }

            $foto_guru = $request->file('foto');
            $nama_foto =  'foto-guru' . md5(rand()) . uniqid() .
                time() . date('ymd') . '.' . $foto_guru->getClientOriginalExtension();

            $foto_guru->move($path_foto_guru, $nama_foto);


            $guru = Guru::find($id);
            $guru->nama = $request->nama;
            $guru->telp = $request->telp;
            $guru->alamat = $request->alamat;
            $guru->foto = $nama_foto;
            $guru->user_id = $request->id;
            $guru->save();

            return redirect()->route('guru');
        }



        $guru = Guru::find($id);
        $guru->nama = $request->nama;
        $guru->telp = $request->telp;
        $guru->alamat = $request->alamat;
        $guru->user_id = $request->id;
        $guru->save();

        return redirect()->route('guru');
    }

    public function hapus($id)
    {
        $guru = Guru::find($id);

        User::where('id', $guru->user_id)->delete();

        $guru->delete();

        return redirect()->route('guru');
    }


    public function listuser(Request $request)
    {

        $user_id_yang_sudah_ada = Guru::whereNotNull('user_id')->pluck('user_id');

        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = User::select("id", "email")
                ->Where('email', 'LIKE', "%$search%")
                ->Where('role_id', '2')
                ->whereNotIn('id', $user_id_yang_sudah_ada)
                ->get();
        } else {
            $data = User::where('role_id', '2')
                ->whereNotIn('id', $user_id_yang_sudah_ada)->get();
        }

        // dd($data);
        return response()->json($data);
    }

    public function listUserGuru(Request $request, $id)
    {
        $guru = Guru::where('id', $id)->first();

        $data = User::find($guru->user_id);

        return response()->json(['user' => json_decode($data)]);
    }
}
