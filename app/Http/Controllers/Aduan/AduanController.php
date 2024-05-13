<?php

namespace App\Http\Controllers\Aduan;

use App\Http\Controllers\Controller;
use App\Models\Aduan;

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
        return view('pengaduan.view', compact('pengaduan'));
    }
}
