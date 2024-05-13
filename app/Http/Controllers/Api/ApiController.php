<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pengaduan;
use App\Http\Requests\AduanRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Aduan;

class ApiController extends Controller
{
    public function loginApi(LoginRequest $request)
    {
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 422);
        }

        $token = $user->createToken('usm_hub')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'is_admin' => $user->isAdmin(),
        ], 200);
    }

    public function createAduan(AduanRequest $request)
    {
        // Mendapatkan pengguna yang sedang login
        $user = auth()->user();

        // Membuat pengaduan
        $pengaduan = new Aduan();
        $pengaduan->user_id = $user->id;
        $pengaduan->jenis_pengaduan = $request->jenis_pengaduan;
        $pengaduan->program_studi = $request->program_studi;
        $pengaduan->keterangan = $request->keterangan;

        if ($request->hasFile('bukti_photo')) {
            $image = $request->file('bukti_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $pengaduan->bukti_photo = $imageName;
        }

        $pengaduan->save();

        return response()->json(['message' => 'Pengaduan berhasil disimpan'], 201);
    }
}
