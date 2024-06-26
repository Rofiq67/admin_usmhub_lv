<?php

namespace App\Http\Controllers\Aduan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Aduan;
use App\Models\User;
use Illuminate\Http\Request;

class AduanController extends Controller
{

    public function index()
    {
        $admin = Auth::user();

        if ($admin->role === 'Superadmin') {
            // Superadmin can see all reports from all programs
            $pengaduan = Aduan::all();
        } else {
            // Admin can only see reports from their own program
            $pengaduan = Aduan::where('program_studi', $admin->progdi)->get();
        }

        return view('pengaduan.index', compact('pengaduan', 'admin'));
    }

    public function view($id)
    {
        $admin = Auth::user();
        $pengaduan = Aduan::findOrFail($id);

        // Check if the admin is allowed to view this report
        if ($admin->role !== 'Superadmin' && $pengaduan->program_studi !== $admin->progdi) {
            return redirect()->route('pengaduan.index')->with('error', 'Anda tidak memiliki izin untuk melihat aduan ini.');
        }

        $user = $pengaduan->user; // Mengambil pengguna yang membuat aduan
        $users = User::where('id', '!=', $user->id)->get(); // Mengambil semua pengguna kecuali pengguna yang membuat aduan

        return view('pengaduan.view', compact('pengaduan', 'users'));
    }

    public function updateStatus($id, $status)
    {
        $admin = Auth::user();
        $aduan = Aduan::findOrFail($id);

        // Check if the admin is allowed to update this report
        if ($admin->role !== 'Superadmin' && $aduan->program_studi !== $admin->progdi) {
            return redirect()->route('pengaduan.index')->with('error', 'Anda tidak memiliki izin untuk memperbarui status aduan ini.');
        }

        $aduan->status = $status;
        $aduan->save();

        return redirect()->route('pengaduan.view', $id)->with('success', 'Status aduan berhasil diubah.');
    }

    public function forwardAduan(Request $request, $id)
    {
        $admin = Auth::user();
        $pengaduan = Aduan::findOrFail($id);

        // Check if the admin is Dekan FTIK or if forwarding to Dekan FTIK
        if ($admin->progdi !== 'Dekan FTIK' && $request->input('program_studi') !== 'Dekan FTIK') {
            return redirect()->route('pengaduan.index')->with('error', 'Anda tidak memiliki izin untuk meneruskan aduan ini.');
        }

        // Check specific forwarding permissions
        if ($admin->progdi === 'Dekan FTIK') {
            // Dekan FTIK can forward to Teknik Informatika, Sistem Informasi, Ilmu Komunikasi, Pariwisata
            $allowedProgramStudis = ['Teknik Informatika', 'Sistem Informasi', 'Ilmu Komunikasi', 'Pariwisata'];
            if (!in_array($request->input('program_studi'), $allowedProgramStudis)) {
                return redirect()->route('pengaduan.view', $id)->with('error', 'Anda hanya bisa meneruskan aduan ke program studi yang diizinkan.');
            }
        } else {
            // Other program studis can only forward to Dekan FTIK
            if ($request->input('program_studi') !== 'Dekan FTIK') {
                return redirect()->route('pengaduan.view', $id)->with('error', 'Anda hanya bisa meneruskan aduan ke Dekan FTIK.');
            }
        }

        $pengaduan->program_studi = $request->input('program_studi');
        $pengaduan->save();

        return redirect()->route('pengaduan.view', $id)->with('success', 'Aduan berhasil diteruskan.');
    }
}
