<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class KaryawanManagementController extends Controller
{
    public function index()
    {
        $karyawan = User::role('karyawan')->get();
        return view('karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('karyawan');

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit(User $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, User $karyawan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $karyawan->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $karyawan->name = $request->name;
        $karyawan->email = $request->email;
        if ($request->password) {
            $karyawan->password = Hash::make($request->password);
        }
        $karyawan->save();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diperbarui.');
    }

    public function destroy(User $karyawan)
    {
        $karyawan->delete();
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}
