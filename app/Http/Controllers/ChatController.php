<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Request $request, $userId = null)
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $activeUser = $userId ? User::findOrFail($userId) : null;
        
        $messages = [];
        if ($activeUser) {
            $messages = Message::where(function($q) use ($activeUser) {
                $q->where('sender_id', Auth::id())->where('receiver_id', $activeUser->id);
            })->orWhere(function($q) use ($activeUser) {
                $q->where('sender_id', $activeUser->id)->where('receiver_id', Auth::id());
            })->orderBy('created_at', 'asc')->get();
            
            // Mark as read
            Message::where('sender_id', $activeUser->id)
                   ->where('receiver_id', Auth::id())
                   ->where('is_read', false)
                   ->update(['is_read' => true]);
        }

        return view('chat.index', compact('users', 'activeUser', 'messages'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($message->load('sender'));
        }

        return back();
    }
}
