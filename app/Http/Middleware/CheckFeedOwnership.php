<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Feed;

class CheckFeedOwnership
{
    public function handle(Request $request, Closure $next)
    {
        $feedId = $request->route('id'); // Ambil ID feed dari route
        $feed = Feed::findOrFail($feedId); // Temukan feed berdasarkan ID

        // Periksa apakah user yang sedang login memiliki akses ke feed ini
        if ($feed->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
