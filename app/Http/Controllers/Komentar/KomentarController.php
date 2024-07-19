<?php

namespace App\Http\Controllers\Komentar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
            // Save file to admin_usmhub
            $file = $request->file('file')->storeAs('file_komentar', $request->file('file')->getClientOriginalName(), 'public');

            // Save file to api_usmhub
            $response = Http::attach(
                'file',
                file_get_contents($request->file('file')->getRealPath()),
                $request->file('file')->getClientOriginalName()
            )->post('http://192.168.0.100:80/api/upload/komentar'); // Replace with your local server address

            if ($response->successful()) {
                // Optionally handle response or errors from API
            } else {
                return redirect()->back()->with('error', 'Failed to upload file to API');
            }
        }

        $komentar = Komentar::create([
            'aduan_id' => $request->aduan_id,
            'user_id' => Auth::id(),
            'text' => $request->text,
            'file' => $file,
        ]);

        return redirect()->back()->with('success', 'Komentar successfully sent');
    }
    // public function kirimKomentar(Request $request)
    // {
    //     $request->validate([
    //         'aduan_id' => 'required|exists:aduans,id',
    //         'text' => 'nullable|string',
    //         'file' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048',
    //     ]);

    //     $file = null;
    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file')->store('file_komentar', 'public');
    //     }

    //     $komentar = Komentar::create([
    //         'aduan_id' => $request->aduan_id,
    //         'user_id' => Auth::id(),
    //         'text' => $request->text,
    //         'file' => $file,
    //     ]);

    //     return redirect()->back()->with('success', 'Komentar berhasil dikirim');
    // }

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
        if (!Auth::user()->isAdmin() && !Auth::user()->isSuperAdmin()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk memperbarui komentar ini');
        }


        $komentar->text = $request->text;

        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('file_komentar', 'public');
            if ($komentar->file) {
                Storage::disk('public')->delete($komentar->file);
            }
            $komentar->file = $file;
        }

        if ($request->hasFile('file')) {
            // Save file to api_usmhub
            $file = $request->file('file')->storeAs('file_komentar', $request->file('file')->getClientOriginalName(), 'public');

            // Save file to api_usmhub
            $response = Http::attach(
                'file',
                file_get_contents($request->file('file')->getRealPath()),
                $request->file('file')->getClientOriginalName()
            )->post('http://192.168.0.100:80/api/upload/komentar'); // Replace with your local server address

            if (!$response->successful()) {
                return redirect()->back()->with('error', 'Failed to upload file to Admin');
            }

            if ($komentar->file) {
                Storage::disk('public')->delete($komentar->file);
            }
            $komentar->file = $file;
        }

        $komentar->save();

        return redirect()->back()->with('success', 'Komentar berhasil diperbarui');
    }

    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);

        // Cek apakah pengguna saat ini adalah admin
        if (!Auth::user()->isAdmin() && !Auth::user()->isSuperAdmin()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini');
        }

        $komentar->delete();
        return redirect()->back()->with('success', 'Komentar berhasil dihapus');
    }
}
