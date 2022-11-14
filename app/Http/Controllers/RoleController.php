<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        $items = Role::all();

        return view('pages.role.index', [
            'items' => $items
        ]);
    }

    public function tambah()
    {
        return view('pages.role.create');
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'role' => 'required|unique:role,role'
        ], [
            'role.required' => 'tidak boleh kosong',
            'role.unique' => 'role sudah digunakan silahkan input yang lain'
        ]);

        $role = new Role();
        $role->role = $request->role;
        $role->save();

        return redirect()->route('role')->with('status', 'Data berhasil ditambah');
    }

    public function edit($id)
    {
        $item = Role::find($id);

        return view('pages.role.edit', [
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'role' => 'required', [
                    Rule::unique('role')->ignore($request->id, 'role')
                ]
            ],

            [
                'role.required' => 'tidak boleh kosong'
            ]
        );

        $role = Role::find($id);
        $role->role = $request->role;
        $role->save();

        return redirect()->route('role')->with('status', 'Data berhasil diubah');
    }

    public function hapus($id)
    {
        $item = Role::find($id);

        $item->delete();

        return redirect()->route('role')->with('status', 'Data berhasil dihapus');
    }
}
