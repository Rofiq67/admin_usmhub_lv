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

        if ($admin->isSuperAdmin()) {
            $datamhs = User::where('id', '!=', $admin->id)->get();
        }
        // Jika admin dengan progdi "Dekan FTIK", tampilkan semua user dengan role 'user'
        elseif ($admin->isAdmin() && $admin->progdi == 'Dekan FTIK') {
            $datamhs = User::where('role', 'user')->where('id', '!=', $admin->id)->get();
        }
        // Jika admin dengan progdi lain, tampilkan user dengan role 'user' sesuai progdi admin
        else {
            $datamhs = User::where('progdi', $admin->progdi)
                ->where('role', 'user')
                ->where('id', '!=', $admin->id)
                ->get();
        }

        return view('users.index', compact('datamhs', 'admin'));
    }

    public function view($id)
    {
        $user = User::findOrFail($id);

        return view('users.view', compact('user'));
    }
}
