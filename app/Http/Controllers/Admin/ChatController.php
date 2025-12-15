<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use Illuminate\Contracts\View\View;
use App\Models\User;
use Illuminate\Support\Carbon;

class ChatController extends Controller
{
    public function chat(Request $request, ?string $rid = null): View {
        $myId = Auth::id();

        if ($rid) {
            Chat::where('penerima_id', $myId)->where('pengirim_id', $rid)
                ->update(['status' => 'dibaca']);
        }

        $users = User::where('id', '!=', $myId)
            ->where(function ($query) use ($myId) {
                $query->whereHas('chatsAsSender', function ($q) use ($myId) {
                    $q->where('penerima_id', $myId);
                })
                ->orWhereHas('chatsAsReceiver', function ($q) use ($myId) {
                    $q->where('pengirim_id', $myId);
                });
            })
            ->get();

        $messages = $rid ? Chat::getMessageWith($rid) : null;

        foreach ($users as $user) {
            $lastMessage = Chat::getLastMessageWith($user->id);
            $user['last_message'] = $lastMessage?->pesan;
            $user['last_time'] = Carbon::parse($lastMessage?->waktu_kirim)?->toTimeString();
            $user['unread'] = Chat::getUnreadMessagesWith($user->id)->count();
        }

        return view('admin.chat', [
            'contacts' => $users,
            'messages' => $messages,
            'rid' => $rid,
            'rcontact' => $rid ? User::where('id', $rid)->first() : null,
        ]);
    }
}
