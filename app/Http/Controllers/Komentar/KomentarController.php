<?php

namespace App\Http\Controllers\Komentar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aduan;
use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function index($aduan_id)
    {
        $komentars = Komentar::where('aduan_id', $aduan_id)->get();
        return view('komentar.index', compact('komentars'));
    }

    public function kirimKomentar(Request $request)
    {
        $request->validate([
            'aduan_id' => 'required|exists:aduans,id',
            'text' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048',
        ]);

        $file = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('file_komentar', 'public');
        }

        $komentar = Komentar::create([
            'aduan_id' => $request->aduan_id,
            'user_id' => Auth::id(),
            'text' => $request->text,
            'file' => $file,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil dikirim');
    }

    public function edit($id)
    {
        $komentar = Komentar::findOrFail($id);
        return view('komentar.edit', compact('komentar'));
    }

    public function updateKomentar(Request $request, $id)
    {
        $request->validate([
            'text' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048',
        ]);

        $komentar = Komentar::findOrFail($id);

        // Cek apakah pengguna saat ini adalah admin
        if (Auth::user()->is_admin) {
            // Jika admin, cek apakah komentar yang akan diupdate adalah milik pengguna lain
            if ($komentar->user_id != Auth::id()) {
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk memperbarui komentar ini');
            }
        }

        $komentar->text = $request->text;

        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('file_komentar', 'public');
            $komentar->file = $file;
        }

        $komentar->save();

        return redirect()->back()->with('success', 'Komentar berhasil diperbarui');
    }

    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);

        // Cek apakah pengguna saat ini adalah admin
        if (Auth::user()->is_admin) {
            // Jika admin, cek apakah komentar yang akan dihapus adalah milik pengguna lain
            if ($komentar->user_id != Auth::id()) {
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini');
            }
        }

        $komentar->delete();
        return redirect()->back()->with('success', 'Komentar berhasil dihapus');
    }
}
