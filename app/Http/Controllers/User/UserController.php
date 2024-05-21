<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil semua pengguna kecuali yang berperan sebagai admin
        $users = User::where('is_admin', false)->get();
        return view('users.index', compact('users'));
    }

    public function view($id)
    {
        $users = User::findOrFail($id);
        return view('users.view', compact('users'));
    }
}
