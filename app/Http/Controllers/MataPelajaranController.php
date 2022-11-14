<?php

namespace App\Http\Controllers;

use App\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $items = MataPelajaran::all();
        return view('pages.mapel.index', [
            'items' => $items
        ]);
    }

    public function tambah()
    {
        return view('pages.mapel.create');
    }

    public function simpan(Request $request)
    {

        $this->validate($request, [
            'nama_mapel' => 'required'
        ], [
            'nama_mapel.required' => 'tidak boleh kosong'
        ]);

        $data = $request->all();

        MataPelajaran::create($data);

        return redirect()->route('mapel')->with('status', 'Data berhasil ditambah');
    }

    public function ubah($id)
    {
        $item = MataPelajaran::find($id);

        return view('pages.mapel.edit', [
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'nama_mapel' => 'required'
        ], [
            'nama_mapel.required' => 'tidak boleh kosong'
        ]);

        $item = MataPelajaran::find($id);

        $data = $request->all();

        $item->update($data);

        return redirect()->route('mapel')->with('status', 'Data berhasil diubah');
    }

    public function hapus($id)
    {
        $item = MataPelajaran::find($id);

        $item->delete();

        return redirect()->route('mapel')->with('status', 'Data berhasil dihapus');
    }
}
