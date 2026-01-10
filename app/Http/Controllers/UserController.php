<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KategoriUser;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('kategori')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $kategoris = KategoriUser::all();
        return view('users.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'kategori_user_id' => 'required|exists:kategori_users,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'kategori_user_id' => $request->kategori_user_id,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $kategoris = KategoriUser::all();
        return view('users.edit', compact('user', 'kategoris'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'kategori_user_id' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'kategori_user_id' => $request->kategori_user_id,
        ];

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User dihapus.');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users_data.xlsx');
    }
}