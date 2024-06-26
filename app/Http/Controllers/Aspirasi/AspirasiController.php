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

        if ($admin->role === 'Superadmin') {
            // Superadmin can see all reports from all programs
            $aspirasi = Aspirasi::all();
        } else {
            // Admin can only see reports from their own program
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
            return redirect()->route('aspirasi.index')->with('error', 'Anda tidak memiliki izin untuk melihat aduan ini.');
        }

        $user = $aspirasi->user; // Mengambil pengguna yang membuat aduan
        $users = User::where('id', '!=', $user->id)->get(); // Mengambil semua pengguna kecuali pengguna yang membuat aduan

        return view('aspirasi.view', compact('aspirasi', 'users'));
    }

    public function updateStatus($id, $status)
    {
        $aduan = Aspirasi::findOrFail($id);
        $aduan->status = $status;
        $aduan->save();

        return redirect()->route('aspirasi.view', $id)->with('success', 'Status Aspirasi berhasil diubah.');
    }
}
