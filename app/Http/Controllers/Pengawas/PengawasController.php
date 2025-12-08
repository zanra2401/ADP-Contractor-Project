<?php

namespace App\Http\Controllers\Pengawas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use Illuminate\Contracts\View\View;
use App\Models\User;
use Illuminate\Support\Carbon;

class PengawasController extends Controller
{
        public function chat(Request $request, String|null $rid = null): View {
        $myId = Auth::id();

        if ($rid) {
            Chat::where('penerima_id', Auth::id())->where('pengirim_id', $rid)
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

        $messages = Chat::getMessageWith($rid);

        foreach ($users as $user) {
            $lastMessage = Chat::getLastMessageWith($user->id);
            $user['last_message'] = $lastMessage?->pesan;
            $user['last_time'] = Carbon::parse($lastMessage?->waktu_kirim)?->toTimeString();
            $user['unread'] = Chat::getUnreadMessagesWith($user->id)->count();
        }
        
        return view('pengawas.chat', [
            'contacts' => $users,
            'messages' => $rid ? $messages : null,
            'rid' => $rid,
            'rcontact' => User::where('id', $rid)->first()
        ]);
    }
}
