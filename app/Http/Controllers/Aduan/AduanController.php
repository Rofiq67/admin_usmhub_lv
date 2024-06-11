<?php

namespace App\Http\Controllers\Aduan;

use App\Http\Controllers\Controller;
use App\Http\Requests\AduanRequest;
use App\Http\Requests\Request;
use App\Http\Requests\FeedRequest;
use Illuminate\Support\Facades\Session;
use App\Models\Aduan;
use App\Models\User;

class AduanController extends Controller
{

    public function index()
    {
        $pengaduan = Aduan::all(); // Mengambil semua data pengaduan
        return view('pengaduan.index', compact('pengaduan'));
    }


    public function view($id)
    {
        $pengaduan = Aduan::findOrFail($id);
        $user = $pengaduan->user; // Mengambil pengguna yang membuat aduan
        $users = User::where('id', '!=', $user->id)->get(); // Mengambil semua pengguna kecuali pengguna yang membuat aduan
        return view('pengaduan.view', compact('pengaduan', 'users'));
    }




    public function updateStatus($id, $status)
    {
        $aduan = Aduan::findOrFail($id);
        $aduan->status = $status;
        $aduan->save();

        return redirect()->route('pengaduan.view', $id)->with('success', 'Status aduan berhasil diubah.');
    }
}
