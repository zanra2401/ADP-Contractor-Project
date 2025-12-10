<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Requests\Pengunjung\RegisterPengunjungRequest;
use App\Models\Role;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Factory;
use App\Models\Chat;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{

    public function dashboard(): View|Factory {
        $proyek = Project::where('pengunjung_id', Auth::id())->get();
        foreach ($proyek as $p) {
            $p['content_path'] = $p->design->contents->first()->content_path;
            $p['progress'] = $p->harga / $p->payment->progresses->sum('jumlah') * 100;
        }

        return view('pelanggan.dashboard', compact('proyek'));
    }

    public function detailProject(Request $request, $id): View|Factory {
        $proyek = Project::where('id', $id)->first();
       
        $sudahDibayar = $proyek->payment?->progresses->sum('jumlah');
        $proyek['progress'] = $proyek->harga / $sudahDibayar * 100;
        $proyek['sudah_dibayar'] = $sudahDibayar;

        // dd($proyek->pengawas->nama);
        

        return view('pelanggan.detail-proyek', compact('proyek'));
    }

    public function register(RegisterPengunjungRequest $user): RedirectResponse {    

        $role = Role::where("nama_Role", "pengunjung")->first();

        $data = [
            'nomor_telepon' => $user->nomor_telepon,
            'password' => Hash::make($user->password),
            'nama' => $user->nama,
            'role_id' => $role->id
        ];

        $user = User::create($data);

        try {
            $user->save();
            return redirect()->route('login');
        } catch (Exception $e) {
            return redirect()->to('/register')->with('error', "Gagal Mendaftarkan akun");
        }
    }

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
        
        if ($rid) {
            if ($users->contains('id', $rid) == false) {
                $users->push(User::where('id', $rid)->first());
            }
        }

        $messages = Chat::getMessageWith($rid);

        foreach ($users as $user) {
            $lastMessage = Chat::getLastMessageWith($user->id);
            $user['last_message'] = $lastMessage?->pesan;
            $user['last_time'] = Carbon::parse($lastMessage?->waktu_kirim)?->toTimeString();
            $user['unread'] = Chat::getUnreadMessagesWith($user->id)->count();
        }

        
        
        return view('pelanggan.chat', [
            'contacts' => $users,
            'messages' => $rid ? $messages : null,
            'rid' => $rid,
            'rcontact' => User::where('id', $rid)->first()
        ]);
    }

    public function detailDesign(Request $request): View|Factory {
        return view('pelanggan.detail-desain');
    }
}