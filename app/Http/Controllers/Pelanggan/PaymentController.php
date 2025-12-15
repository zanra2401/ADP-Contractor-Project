<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentProgress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function createSnapToken(Request $request, PaymentProgress $paymentProgress): JsonResponse
    {
        $this->guardPaymentOwnership($paymentProgress);

        if ($paymentProgress->status === 'lunas') {
            return response()->json(['message' => 'Tagihan sudah lunas'], 422);
        }

        $this->configureMidtrans();

        $orderId = 'PAY-'.$paymentProgress->id.'-'.now()->timestamp;
        $amount  = (int) ceil($paymentProgress->jumlah);

        $payload = [
            'transaction_details' => [
                'order_id'      => $orderId,
                'gross_amount'  => $amount,
            ],
            'item_details' => [
                [
                    'id'       => $paymentProgress->id,
                    'price'    => $amount,
                    'quantity' => 1,
                    'name'     => $paymentProgress->deskripsi ?? 'Pembayaran Proyek',
                ],
            ],
            'customer_details' => [
                'first_name' => Auth::user()?->nama ?? Auth::user()?->name,
                'email'      => Auth::user()?->email,
            ],
        ];

        try {
            $transaction = Snap::createTransaction($payload);

            // Snap bisa mengembalikan array atau stdClass, jadi normalisasi dulu
            if (is_object($transaction)) {
                $transaction = (array) $transaction;
            }

            $paymentProgress->update([
                'status' => 'pending',
                'metode' => 'transfer',
            ]);

            return response()->json([
                'token'        => $transaction['token'] ?? null,
                'redirect_url' => $transaction['redirect_url'] ?? null,
            ]);
        } catch (\Throwable $e) {
            Log::error('Midtrans Snap error', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Gagal membuat transaksi. Silakan coba lagi.',
            ], 500);
        }
    }

    public function handleCallback(Request $request): JsonResponse
    {
        $orderId = $request->input('order_id');

        if (!$orderId) {
            return response()->json(['message' => 'Order ID tidak ditemukan'], 400);
        }

        $this->configureMidtrans();

        $signature = hash('sha512',
            $orderId.
            $request->input('status_code').
            $request->input('gross_amount').
            config('midtrans.server_key')
        );

        if ($signature !== $request->input('signature_key')) {
            return response()->json(['message' => 'Signature tidak valid'], 403);
        }

        $progressId = Str::before(Str::after($orderId, 'PAY-'), '-');
        $paymentProgress = PaymentProgress::find($progressId);

        if (!$paymentProgress) {
            return response()->json(['message' => 'Tagihan tidak ditemukan'], 404);
        }

        $transactionStatus = $request->input('transaction_status');

        if (in_array($transactionStatus, ['capture', 'settlement'], true)) {
            $paymentProgress->status = 'lunas';
        } elseif ($transactionStatus === 'pending') {
            $paymentProgress->status = 'pending';
        } else {
            // expired, deny, or cancel → tetap pending agar bisa bayar ulang
            $paymentProgress->status = 'pending';
        }

        $paymentProgress->metode = 'transfer';
        $paymentProgress->save();

        $payment = $paymentProgress->payment;
        if ($payment && $payment->progresses()->where('status', '!=', 'lunas')->count() === 0) {
            $payment->update(['status' => 'selesai']);
        }

        return response()->json(['message' => 'OK']);
    }

    public function invoice(PaymentProgress $paymentProgress)
    {
        $this->guardPaymentOwnership($paymentProgress);

        $payment = $paymentProgress->payment;
        $project = $payment?->project;

        abort_if(!$payment || !$project, 404, 'Data pembayaran tidak ditemukan');

        return view('pelanggan.invoice', [
            'paymentProgress' => $paymentProgress,
            'payment' => $payment,
            'project' => $project,
            'customer' => $payment->project?->pengunjung,
        ]);
    }

    private function configureMidtrans(): void
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = (bool) config('midtrans.is_production');
        Config::$isSanitized  = (bool) config('midtrans.is_sanitized');
        Config::$is3ds        = (bool) config('midtrans.is_3ds');
    }

    private function guardPaymentOwnership(PaymentProgress $progress): void
    {
        if ($progress->payment?->pengunjung_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak membayar tagihan ini');
        }
    }
}

