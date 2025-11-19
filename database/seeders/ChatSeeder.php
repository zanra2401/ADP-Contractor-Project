<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class ChatSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil pengawas & pengunjung
        $pengawas = User::whereHas('role', fn($q) => $q->where('nama_role', 'pengawas'))->first();
        $pengunjung = User::whereHas('role', fn($q) => $q->where('nama_role', 'pengunjung'))->first();

        if (!$pengawas || !$pengunjung) {
            throw new \Exception('Seeder Chat: user pengawas/pengunjung belum ada. Pastikan UserSeeder sudah jalan.');
        }

        DB::table('chats')->insert([
            [
                'id'           => (string) \Symfony\Component\Uid\Ulid::generate(),
                'pengirim_id'  => $pengunjung->id,
                'penerima_id'  => $pengawas->id,
                'pesan'        => 'Selamat siang pak, saya ingin konsultasi terkait desain rumah.',
                'media_path'   => '', // kosong tapi string, karena NOT NULL
                'waktu_kirim'  => Carbon::now(),
                'status'       => 'terkirim',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'id'           => (string) \Symfony\Component\Uid\Ulid::generate(),
                'pengirim_id'  => $pengawas->id,
                'penerima_id'  => $pengunjung->id,
                'pesan'        => 'Baik, bisa dijelaskan kebutuhan dan budgetnya?',
                'media_path'   => '',
                'waktu_kirim'  => Carbon::now()->addMinutes(2),
                'status'       => 'dibaca',
                'created_at'   => Carbon::now()->addMinutes(2),
                'updated_at'   => Carbon::now()->addMinutes(2),
            ],
        ]);
    }
}
