<?php

namespace App\Http\Controllers\Feed;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Feed;

use Illuminate\Support\Facades\Storage;

class FeedController extends Controller
{

    public function index()
    {
        $feed = Feed::all();
        return view('feed.index', compact('feed'));
    }

    public function view($id)
    {
        // Menampilkan detail feed berdasarkan ID
        $feed = Feed::findOrFail($id);
        return view('feed.view', compact('feed'));
    }

    public function create()
    {
        return view('feed.create');
    }

    public function store(FeedRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('doc_feed') && !$request->file('doc_feed')->getClientOriginalExtension() == 'pdf') {
            return redirect()->back()->with('error', 'File harus berupa PDF.');
        }


        if ($request->hasFile('doc_feed')) {
            $data['doc_feed'] = $request->file('doc_feed')->store('documents', 'public');
        }

        if ($request->hasFile('img_banner')) {
            $data['img_banner'] = $request->file('img_banner')->store('photos', 'public');
        }

        $data['status'] = false; // Set default status

        Feed::create($data);

        return redirect()->route('feed.index')->with('success', 'Feed berhasil dibuat.');
    }


    // private function cleanTrixContent($content)
    // {
    //     // Hapus tag <div> yang tidak diperlukan
    //     $content = preg_replace('/<div>(.*?)<\/div>/', '$1', $content);
    //     return $content;
    // }



    public function update(FeedRequest $request, $id)
    {
        // Temukan feed berdasarkan ID
        $feed = Feed::findOrFail($id);

        // Perbarui data feed kecuali img_banner dan doc_feed
        $feed->kategori = $request->kategori;
        $feed->judul = $request->judul;
        $feed->deskripsi = $request->deskripsi;
        $feed->status = $request->has('status') ? $request->status : false;

        // Cek apakah ada file img_banner yang diunggah
        if ($request->hasFile('img_banner')) {
            // Hapus file img_banner lama jika ada
            $oldImgBannerPath = public_path('storage/' . $feed->img_banner);
            if (File::exists($oldImgBannerPath)) {
                File::delete($oldImgBannerPath);
            }
            // Simpan file img_banner yang baru
            $imgBannerPath = $request->file('img_banner')->store('photos', 'public');
            $feed->img_banner = $imgBannerPath;
        }

        // Cek apakah ada file doc_feed yang diunggah
        if ($request->hasFile('doc_feed')) {
            // Hapus file doc_feed lama jika ada
            $oldDocFeedPath = public_path('storage/' . $feed->doc_feed);
            if (File::exists($oldDocFeedPath)) {
                File::delete($oldDocFeedPath);
            }
            // Simpan file doc_feed yang baru
            $docFeedPath = $request->file('doc_feed')->store('documents', 'public');
            $feed->doc_feed = $docFeedPath;
        }

        // Simpan perubahan
        $feed->save();

        // Redirect ke halaman feed view dengan pesan sukses
        return redirect()->route('feed.view', $feed->id)->with('success', 'Informasi berhasil diperbarui.');
    }




    public function edit($id)
    {
        $feed = Feed::findOrFail($id);
        return view('feed.edit', compact('feed'));
    }

    public function destroy($id)
    {
        $feed = Feed::findOrFail($id);
        $feed->delete();

        return redirect()->route('feed.index')->with('danger', 'Feed berhasil dihapus.');
    }

    // public function uploadFeed($id)
    // {
    //     $feed = Feed::find($id);

    //     if (!$feed) {
    //         return redirect()->back()->with('error', 'Feed tidak ditemukan.');
    //     }

    //     // Proses upload feed di sini

    //     // Jika upload berhasil
    //     $feed->uploaded = true;
    //     $feed->status = 'Terupload'; // Ubah status sesuai kebutuhan
    //     $feed->save();

    //     return redirect()->route('view.feed', $feed->id)->with('success', 'Feed berhasil diupload.');
    // }
}
