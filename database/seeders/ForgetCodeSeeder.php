<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ForgetCode;
use Carbon\Carbon;

class ForgetCodeSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            throw new \Exception('Seeder ForgetCode: User belum ada.');
        }

        ForgetCode::create([
            'user_id'    => $user->id,
            'expired_at' => Carbon::now()->addHours(1),
        ]);
    }
}
