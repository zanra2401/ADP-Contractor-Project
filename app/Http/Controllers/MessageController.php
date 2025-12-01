<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\MessageRequest;
use App\Models\Chat;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Event\MessageEvent;
use App\Models\User;

class MessageController extends Controller
{
    public function sendMessage(MessageRequest $message): Response {
        try {

            $path = $message->media->store('uploads', 'public');
    
            $chat = Chat::create([
                'pesan' => $message->pesan,
                'media_path' => $path,
                'penerima_id' =>  $message->penerima_id
            ]);

            $chat->save();
            
            broadcast(new MessageSent(User::where('nama', 'Pengunjung Pertama')->first(), $chat))->toOthers();

            return response()->json([
                'message' => "berhasil mengirim pesan"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "gagal mengirim pesan"
            ]);
        }
    }
}
