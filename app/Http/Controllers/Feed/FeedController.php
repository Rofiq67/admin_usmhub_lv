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
        $user = auth()->user();

        if ($user->role === 'Superadmin') {
            // Superadmin can see all feeds
            $feeds = Feed::with('user')->get();
        } else {
            $feeds = Feed::with('user')->where('user_id', $user->id)->get();
        }

        return view('feed.index', compact('feeds'));
    }

    public function view($id)
    {
        $feed = Feed::findOrFail($id);

        // Ensure only the owner or Superadmin can view the feed
        if (auth()->user()->role !== 'Superadmin' && $feed->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('feed.view', compact('feed'));
    }

    public function create()
    {
        return view('feed.create');
    }

    public function store(FeedRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();

        if ($request->hasFile('doc_feed') && !$request->file('doc_feed')->getClientOriginalExtension() == 'pdf') {
            return redirect()->back()->with('error', 'File harus berupa PDF.');
        }


        if ($request->hasFile('doc_feed')) {
            $data['doc_feed'] = $request->file('doc_feed')->store('documents', 'public');
        }

        if ($request->hasFile('img_banner')) {
            $data['img_banner'] = $request->file('img_banner')->store('photos', 'public');
        }

        Feed::create($data);

        return redirect()->route('feed.index')->with('success', 'Feed berhasil dibuat.');
    }

    public function update(FeedRequest $request, $id)
    {
        $feed = Feed::findOrFail($id);

        if (auth()->user()->role !== 'Superadmin' && $feed->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $feed->update($request->only('kategori', 'judul', 'deskripsi'));

        if ($request->hasFile('img_banner')) {
            $oldImgBannerPath = public_path('storage/' . $feed->img_banner);
            if (File::exists($oldImgBannerPath)) {
                File::delete($oldImgBannerPath);
            }
            $feed->img_banner = $request->file('img_banner')->store('photos', 'public');
        }

        if ($request->hasFile('doc_feed')) {
            $oldDocFeedPath = public_path('storage/' . $feed->doc_feed);
            if (File::exists($oldDocFeedPath)) {
                File::delete($oldDocFeedPath);
            }
            $feed->doc_feed = $request->file('doc_feed')->store('documents', 'public');
        }

        $feed->save();

        return redirect()->route('feed.view', $feed->id)->with('success', 'Informasi berhasil diperbarui.');
    }

    public function edit($id)
    {
        $feed = Feed::findOrFail($id);

        if (auth()->user()->role !== 'Superadmin' && $feed->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('feed.edit', compact('feed'));
    }

    public function destroy($id)
    {
        $feed = Feed::findOrFail($id);

        if (auth()->user()->role !== 'Superadmin' && $feed->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($feed->img_banner) {
            Storage::disk('public')->delete($feed->img_banner);
        }
        if ($feed->doc_feed) {
            Storage::disk('public')->delete($feed->doc_feed);
        }

        $feed->delete();

        return redirect()->route('feed.index')->with('success', 'Informasi berhasil dihapus.');
    }
}
