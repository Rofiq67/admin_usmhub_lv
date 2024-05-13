<?php

namespace App\Http\Controllers\Aduan;

use App\Http\Controllers\Controller;
use App\Http\Requests\AduanRequest;
use App\Models\Aduan;
use Illuminate\Support\Facades\Auth;

class AduanController extends Controller
{
    public function riwayatPengaduan()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login

        // Ambil semua pengaduan berdasarkan user_id
        $riwayat = Aduan::where('user_id', $user->id)->get();

        return response()->json($riwayat, 200);
    }
    /**
     * Menambahkan pengaduan baru.
     */
    public function createPengaduan(AduanRequest $request)
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $photoPath = null;
        if ($request->hasFile('bukti_photo')) {
            $photoPath = $request->file('bukti_photo')->store('photos', 'public');
        }

        $pengaduan = Aduan::create([
            'user_id' => $user->id, // Set user_id berdasarkan pengguna yang sedang login
            'jenis_pengaduan' => $request->jenis_pengaduan,
            'program_studi' => $request->program_studi,
            'keterangan' => $request->keterangan,
            'rating' => $request->rating,
            'bukti_photo' => $photoPath,
        ]);

        return response()->json([
            'message' => 'Pengaduan berhasil dibuat',
            'pengaduan' => $pengaduan
        ], 201);
    }

    /**
     * Mendapatkan daftar pengaduan.
     */
    public function listPengaduan()
    {
        $pengaduan = Aduan::all(); // Mengambil semua data pengaduan
        return response()->json($pengaduan, 200); // Status HTTP 200 (OK)
    }

    public function index()
    {
        $pengaduan = Aduan::all(); // Mengambil semua data pengaduan
        return view('pengaduan.index', compact('pengaduan'));
    }


    public function view()
    {
        return view('pengaduan.view');
    }
}
