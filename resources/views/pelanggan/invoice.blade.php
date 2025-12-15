<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $project->nama_proyek ?? 'Proyek' }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 32px; color: #111827; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        .badge { padding: 4px 10px; border-radius: 999px; font-size: 12px; border: 1px solid #16a34a; color: #16a34a; }
        .muted { color: #6b7280; font-size: 12px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { padding: 12px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        .table th { background: #f9fafb; font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.04em; }
        .totals { margin-top: 24px; width: 100%; }
        .totals td { padding: 6px 0; }
        .right { text-align: right; }
        .print-btn { margin-top: 24px; padding: 10px 16px; border: none; background: #2563eb; color: white; border-radius: 8px; cursor: pointer; }
        .print-btn:hover { background: #1d4ed8; }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h1 style="margin:0; font-size: 24px;">Invoice</h1>
            <p class="muted" style="margin:4px 0 0;">ID: {{ $paymentProgress->id }}</p>
            <p class="muted" style="margin:2px 0 0;">Tanggal: {{ now()->format('d M Y') }}</p>
        </div>
        <div style="text-align:right;">
            <h3 style="margin:0;">ADP Konstruksi</h3>
            <p class="muted" style="margin:4px 0 0;">Jl. Proyek No.1</p>
            <p class="muted" style="margin:2px 0 0;">admin@adp.co</p>
            <span class="badge">Lunas</span>
        </div>
    </div>

    <hr style="border:none; border-top:1px solid #e5e7eb; margin:20px 0;">

    <div style="display:flex; justify-content: space-between; gap:24px;">
        <div style="flex:1;">
            <p class="muted" style="margin:0 0 4px;">Tagihan Kepada</p>
            <p style="margin:0; font-weight:600;">{{ $customer->nama ?? $customer->name ?? 'Pelanggan' }}</p>
            <p class="muted" style="margin:2px 0 0;">{{ $customer->email ?? '-' }}</p>
        </div>
        <div style="flex:1; text-align:right;">
            <p class="muted" style="margin:0 0 4px;">Proyek</p>
            <p style="margin:0; font-weight:600;">{{ $project->nama_proyek ?? '-' }}</p>
            <p class="muted" style="margin:2px 0 0;">{{ $project->alamat ?? '-' }}</p>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Deskripsi</th>
                <th class="right">Jumlah</th>
                <th class="right">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div style="font-weight:600; color:#111827;">{{ $paymentProgress->deskripsi ?? 'Pembayaran Proyek' }}</div>
                    <div class="muted">Proyek: {{ $project->nama_proyek ?? '-' }}</div>
                </td>
                <td class="right" style="font-weight:600;">{{ Number::currency($paymentProgress->jumlah, 'IDR') }}</td>
                <td class="right">
                    <span style="padding:4px 10px; border-radius:999px; background:#dcfce7; color:#15803d; font-size:12px; font-weight:700;">{{ strtoupper($paymentProgress->status) }}</span>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="totals">
        <tr>
            <td style="color:#6b7280;">Subtotal</td>
            <td class="right" style="font-weight:600;">{{ Number::currency($paymentProgress->jumlah, 'IDR') }}</td>
        </tr>
        <tr>
            <td style="color:#6b7280;">PPN</td>
            <td class="right" style="font-weight:600;">{{ Number::currency(0, 'IDR') }}</td>
        </tr>
        <tr>
            <td style="color:#111827; font-weight:700;">Total</td>
            <td class="right" style="font-weight:700;">{{ Number::currency($paymentProgress->jumlah, 'IDR') }}</td>
        </tr>
    </table>

    <button class="print-btn" onclick="window.print()">Cetak / Simpan PDF</button>
</body>
</html>
