<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetail;

class UserDetailSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            UserDetail::create([
                'user_id'       => $user->id,
                'photo_profile' => null,
                'alamat'        => 'Alamat default untuk ' . $user->nama,
            ]);
        }
    }
}
