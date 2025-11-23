<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Data Admin',
            'menuAdmin' => 'active',
            'breadcrumb' => [
                ['name' => 'Dashboard', 'url' => route('dashboard')],
                ['name' => 'Data Admin', 'url' => null],
            ],
            'user' => User::all(),
        ];

        return view('admin/user/index', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Admin',
            'menuAdmin' => 'active',
            'breadcrumb' => [
                ['name' => 'Dashboard', 'url' => route('dashboard')],
                ['name' => 'Data Admin', 'url' => route('user')],
                ['name' => 'Edit Data Admin', 'url' => null],
            ],
            'user' => User::findOrFail($id),
        ];
        return view('admin/user/edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable|confirmed|min:8',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username sudah ada',
            'password.required' => 'Password  tidak boleh kosong',
            'password.confirmed' => 'Password konfirmasi tidak sama',
            'password.min' => 'Password minimal 8 karakter',
        ]);
        $user = User::findOrFail($id);
        $user->nama = $request->nama;
        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('user')->with('success', 'Data Admin Berhasil Diupdate');
    }
}
