<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $items = User::with(['role'])->get();

        return view('pages.users.index', [
            'items' => $items
        ]);
    }

    public function tambah()
    {
        return view('pages.users.create');
    }

    public function listrole(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Role::select("id", "role")
                ->Where('role', 'LIKE', "%$search%")
                ->Where('role', '!=', 'admin')
                ->get();
        } else {
            $data = Role::all();
        }

        // dd($data);
        return response()->json($data);
    }

    public function simpan(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role_id' => 'required'
        ], [
            'name.required' => 'tidak boleh kosong',
            'email.required' => 'tidak boleh kosong',
            'email.unique' => 'email sudah digunakan',
            'password.required' => 'tidak boleh kosong',
            'password.min' => 'minimal 8 karakter',
            'role_id.required' => 'tidak boleh kosong'
        ]);

        $data = $request->all();

        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('users')->with('status', 'Data berhasil ditambah');
    }

    public function roleByUser(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        $role = Role::find($user->role_id);

        return response()->json(['role' => json_decode($role)]);
    }

    public function edit($id)
    {

        $item = User::find($id);

        return view('pages.users.edit', [
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {

        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required', [
                    Rule::unique('users')->ignore('email')
                ],
                'password' => 'nullable|min:8',
                'role_id' => 'required',
            ],
            [
                'name.required' => 'tidak boleh kosong',
                'email.required' => 'tidak boleh kosong',
                'password.min' => 'minimal 8 karakter',
                'role_id' => 'tidak boleh kosong'
            ]


        );

        $user = User::find($id);

        $data = $request->all();

        if (empty($data['password'])) {
            $data['password'] = $user->password;
        } else {
            $data['password'] = Hash::make($request->password);
        }


        $user->update($data);

        return redirect()->route('users')->with('status', 'Data berhasil diubah');
    }

    public function hapus($id)
    {
        $item = User::find($id);

        // dd($item);

        $item->delete();

        return redirect()->route('users')->with('status', 'Data berhasil dihapus');
    }
}
