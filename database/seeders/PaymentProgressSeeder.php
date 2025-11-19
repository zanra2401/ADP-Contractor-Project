<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\PaymentProgress;
use Carbon\Carbon;

class PaymentProgressSeeder extends Seeder
{
    public function run(): void
    {
        $payment = Payment::first();

        if (!$payment) {
            throw new \Exception('Seeder PaymentProgress: Payment belum ada. Jalankan PaymentSeeder dulu.');
        }

        PaymentProgress::create([
            'payment_id' => $payment->id,
            'jumlah'     => $payment->total_harga * 0.3, // 30% DP
            'metode'     => 'transfer',
        ]);

        PaymentProgress::create([
            'payment_id' => $payment->id,
            'jumlah'     => $payment->total_harga * 0.7, // pelunasan
            'metode'     => 'cash',
        ]);
    }
}
