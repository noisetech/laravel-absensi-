<?php

namespace App\Http\Controllers;

use App\Guru;
use App\ListPelajaran;
use App\MataPelajaran;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\List_;

class ListPelajaranController extends Controller
{
    public function index()
    {
        $items = ListPelajaran::with(['mata_pelajaran', 'guru'])->get();

        return view('pages.list-pelajaran.index', [
            'items' => $items
        ]);
    }

    public function tambah()
    {
        return view('pages.list-pelajaran.create');
    }

    public function simpan(Request $request)
    {
        $list_pelajaran = new ListPelajaran();
        $list_pelajaran->mata_pelajaran_id = $request->mata_pelajaran_id;
        $list_pelajaran->guru_id = $request->guru_id;
        $list_pelajaran->hari = $request->hari;
        $list_pelajaran->waktu_mulai = $request->waktu_mulai;
        $list_pelajaran->waktu_selesai = $request->waktu_selesai;

        // dd($list_pelajaran);
        $list_pelajaran->save();

        return redirect()->route('list-pelajaran');
    }

    public function edit($id)
    {
        $item = ListPelajaran::find($id);

        return view('pages.list-pelajaran.edit', [
            'item' => $item
        ]);
    }


    public function ubah(Request $request, $id)
    {
        $list_pelajaran = ListPelajaran::find($id);
        $list_pelajaran->mata_pelajaran_id = $request->mata_pelajaran_id;
        $list_pelajaran->guru_id = $request->guru_id;
        $list_pelajaran->hari = $request->hari;
        $list_pelajaran->waktu_mulai = $request->waktu_mulai;
        $list_pelajaran->waktu_selesai = $request->waktu_selesai;
        $list_pelajaran->save();

        return redirect()->route('list-pelajaran');
    }

    public function hapus($id)
    {
        $item = ListPelajaran::find($id);

        $item->delete();

        return redirect()->route('list-pelajaran');
    }

    public function mata_pelajaran(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = MataPelajaran::select("id", "nama_mapel")
                ->Where('nama_mapel', 'LIKE', "%$search%")
                ->get();
        } else {
            $data = MataPelajaran::all();
        }

        // dd($data);
        return response()->json($data);
    }


    public function pengajar(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Guru::select("id", "nama")
                ->Where('nama', 'LIKE', "%$search%")
                ->get();
        } else {
            $data = MataPelajaran::all();
        }

        // dd($data);
        return response()->json($data);
    }
}
