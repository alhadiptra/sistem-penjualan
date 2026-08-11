<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('owner.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('owner.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('owner.admins.index')
            ->with('success', 'Admin berhasil ditambahkan!');
    }

    public function edit(User $admin)
    {
        if ($admin->role !== 'admin') {
            abort(404);
        }

        return view('owner.admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        if ($admin->role !== 'admin') {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $admin->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('owner.admins.index')
            ->with('success', 'Admin berhasil diupdate!');
    }

    public function destroy(User $admin)
    {
        if ($admin->role !== 'admin') {
            abort(404);
        }

        if ($admin->id === auth()->id()) {
            return redirect()->route('owner.admins.index')
                ->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $admin->delete();

        return redirect()->route('owner.admins.index')
            ->with('success', 'Admin berhasil dihapus!');
    }
}
