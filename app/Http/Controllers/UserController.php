<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ===============================
    // LIST USER
    // ===============================
    public function index()
    {
        $users = User::latest()->get();
        return view('User.user', compact('users'));
    }

    // ===============================
    // FORM CREATE
    // ===============================
    public function create()
    {
        return view('User.create', ['user' => null]);
    }

    // ===============================
    // FORM EDIT
    // ===============================
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('User.create', compact('user'));
    }

    // ===============================
    // SIMPAN USER (TANPA STATUS)
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        $this->logAktivitas("Tambah user: {$user->name}");

        return redirect()->route('user')->with('success', 'User berhasil ditambahkan');
    }

    // ===============================
    // UPDATE USER (TANPA STATUS)
    // ===============================
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ];

        // 🔥 FIX PASSWORD
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        $this->logAktivitas("Edit user: {$user->name}");

        return redirect()->route('user')->with('success', 'User berhasil diupdate');
    }

    // ===============================
    // DELETE USER
    // ===============================
    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user')->with('error', 'User tidak ditemukan');
        }

        $nama = $user->name;
        $user->delete();

        $this->logAktivitas("Hapus user: {$nama}");

        return redirect()->route('user')->with('success', 'User berhasil dihapus');
    }

    // ===============================
    // LOG AKTIVITAS
    // ===============================
    private function logAktivitas($text)
    {
        DB::table('t_log_aktivitas')->insert([
            'id_user' => auth()->id(),
            'aktivitas' => $text,
            'waktu_aktivitas' => now()
        ]);
    }
}
