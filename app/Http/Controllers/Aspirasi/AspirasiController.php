<?php

namespace App\Http\Controllers\Aspirasi;

use App\Http\Controllers\Controller;
use App\Http\Requests\AspirasiRequest;
use App\Models\Aspirasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    public function index()
    {
        $admin = Auth::user();

        $admin = Auth::user();
        $isSuperadmin = $admin->role === 'Superadmin';
        $isDekanFTIK = $admin->role === 'Admin' && $admin->progdi === 'Dekan FTIK';
        $adminProgramStudi = $admin->progdi;

        if ($isSuperadmin && $isDekanFTIK) {
            $aspirasi = Aspirasi::all();
        } else if ($isDekanFTIK) {
            $aspirasi = Aspirasi::all();
        } else {
            $aspirasi = Aspirasi::where('program_studi', $admin->progdi)->get();
        }

        return view('aspirasi.index', compact('aspirasi', 'admin'));
    }


    public function view($id)
    {
        $admin = Auth::user();
        $aspirasi = Aspirasi::findOrFail($id);

        // Check if the admin is allowed to view this report
        if ($admin->role !== 'Superadmin' && $aspirasi->program_studi !== $admin->progdi) {
            return redirect()->route('aspirasi.index')->with('error', 'Anda tidak memiliki izin untuk melihat Aspirasi ini.');
        }

        $user = $aspirasi->user; // Mengambil pengguna yang membuat Aspirasi
        $users = User::where('id', '!=', $user->id)->get(); // Mengambil semua pengguna kecuali pengguna yang membuat Aspirasi

        return view('aspirasi.view', compact('aspirasi', 'users'));
    }

    public function updateStatus($id, $status)
    {
        $Aspirasi = Aspirasi::findOrFail($id);
        $Aspirasi->status = $status;
        $Aspirasi->save();

        return redirect()->route('aspirasi.view', $id)->with('success', 'Status Aspirasi berhasil diubah.');
    }
}
