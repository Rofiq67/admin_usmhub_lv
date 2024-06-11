<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\RoomUser;
use App\Models\Chat;
use App\Models\User;
use App\Events\ChatEvent;

class ChatController extends Controller
{
    public function index()
    {
        $rooms = ChatRoom::all();
        return view('chat.index', compact('rooms'));
    }

    public function roomUsers($userId)
    {
        $authUserId = auth()->id();

        // Cari room berdasarkan kedua user (admin dan pengguna yang mengadu)
        $room = ChatRoom::whereHas('users', function ($query) use ($authUserId, $userId) {
            $query->where(function ($query) use ($authUserId, $userId) {
                $query->where('user_id', $authUserId)
                    ->orWhere('user_id', $userId);
            });
        })->first();

        // Jika room tidak ditemukan, buat room baru dan lampirkan kedua user
        if (!$room) {
            $room = new ChatRoom();
            $room->name = 'Admin-Pengguna';
            $room->save();
            $room->users()->attach($authUserId);
            $room->users()->attach($userId);
        }

        $users = $room->users;
        $chats = $room->chats;

        return view('chat.room_chat_user', compact('users', 'room', 'chats'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'message' => 'required|string',
            'file' => 'sometimes|file|max:10240'
        ]);

        // Pastikan hanya pengguna yang sesuai yang dapat mengakses obrolan
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Pastikan pengguna yang dipilih adalah pengguna yang sesuai
        $user = User::findOrFail($request->user_id);

        $room = ChatRoom::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', auth()->id())
                ->orWhere('user_id', $user->id);
        })->first();

        // Jika room tidak ditemukan, buat room baru dan lampirkan kedua user
        if (!$room) {
            $room = new ChatRoom();
            $room->name = 'Admin-Pengguna';
            $room->save();
            $room->users()->attach(auth()->id());
            $room->users()->attach($user->id);
        }

        $chat = new Chat([
            'room_id' => $room->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('chat_files', 'public');
            $chat->file_path = $path;
        }

        $chat->save();

        event(new ChatEvent($room->id, $chat->message, auth()->id()));

        return redirect()->back()->with('success', 'Message sent successfully.');
    }


    public function chatHistory()
    {
        $chats = Chat::latest()->get();
        return response()->json($chats);
    }
}
