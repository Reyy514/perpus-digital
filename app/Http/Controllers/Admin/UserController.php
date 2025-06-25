<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'mahasiswa');

        // Terapkan filter pencarian jika ada
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Toggle the status of a user.
     */
    public function toggleStatus(User $user)
    {
        $user->status = $user->status === 'active' ? 'suspended' : 'active';
        $user->save();

        $message = $user->status === 'active' ? 'diaktifkan' : 'disuspend';

        return back()->with('success', 'Akun pengguna berhasil ' . $message . '.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Validasi agar tidak menghapus admin lain (jika perlu)
        if ($user->isAdmin() && $user->id !== auth()->id()) {
             return back()->with('error', 'Anda tidak dapat menghapus akun admin lain.');
        }

        $user->delete();

        return back()->with('success', 'Akun pengguna berhasil dihapus.');
    }
}