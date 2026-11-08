<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (! Auth::user()->isSuperAdmin()) {
            abort(403, 'Akses terbatas untuk Super Admin.');
        }

        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        if (! Auth::user()->isSuperAdmin()) {
            abort(403, 'Akses terbatas untuk Super Admin.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:super_admin,admin',
            'phone' => 'nullable|string|max:30',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'phone' => $validated['phone'] ?? null,
            'is_active' => true,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Akun pengelola berhasil dibuat.');
    }

    public function update(Request $request, User $user)
    {
        if (! Auth::user()->isSuperAdmin()) {
            abort(403, 'Akses terbatas untuk Super Admin.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => "required|email|unique:users,email,{$user->id}",
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:super_admin,admin',
            'phone' => 'nullable|string|max:30',
            'is_active' => 'nullable|boolean',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'phone' => $validated['phone'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Akun pengelola berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if (! Auth::user()->isSuperAdmin()) {
            abort(403, 'Akses terbatas untuk Super Admin.');
        }

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Akun pengelola berhasil dihapus.');
    }
}
