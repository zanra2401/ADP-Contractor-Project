<?php

namespace App\Http\Controllers\CS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\View\View;

class CSController extends Controller
{
    public function chat(Request $request, String|null $rid = null): View {
        $myId = Auth::id();

        $users = User::where('id', '!=', $myId) // Jangan ambil diri sendiri
            ->where(function ($query) use ($myId) {
                $query->whereHas('chatsAsSender', function ($q) use ($myId) {
                    $q->where('penerima_id', $myId);
                })
                ->orWhereHas('chatsAsReceiver', function ($q) use ($myId) {
                    $q->where('pengirim_id', $myId);
                });
            })
            ->get();

        $messages = Chat::getMessageWith($rid);

        foreach ($users as $user) {
            $lastMessage = Chat::getLastMessageWith($user->id);
            $user['last_message'] = $lastMessage?->pesan;
            $user['last_time'] = Carbon::parse($lastMessage?->waktu_kirim)?->toTimeString();
            $user['unread'] = Chat::getUnreadMessagesWith($user->id)->count();
        }

        if ($rid) {
            Chat::where('penerima_id', Auth::id())->where('pengirim_id', $rid)
                ->update(['status' => 'dibaca']);
        }
        
        return view('CS.dashboard', [
            'contacts' => $users,
            'messages' => $rid ? $messages : null,
            'rid' => $rid,
            'rcontact' => User::where('id', $rid)->first()
        ]);
    }
}
