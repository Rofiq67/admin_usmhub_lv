<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $admin = Auth::user();

        // Jika superadmin atau admin dengan progdi "Dekan FTIK", tampilkan semua user
        if ($admin->isSuperAdmin() || ($admin->isAdmin() && $admin->progdi == 'Dekan FTIK')) {
            $datamhs = User::whereNotIn('role', ['superadmin', 'admin'])->get();
        } else {
            // Jika admin dengan progdi lain, tampilkan user sesuai dengan progdi admin
            $datamhs = User::where('progdi', $admin->progdi)->whereNotIn('role', ['superadmin', 'admin'])->get();
        }

        return view('users.index', compact('datamhs', 'admin'));
    }

    public function view($id)
    {
        $user = User::findOrFail($id);

        return view('users.view', compact('user'));
    }
}
