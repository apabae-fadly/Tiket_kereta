<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tiket Kereta</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .badge { background: #4e73df; color: #fff; padding: 8px 20px; border-radius: 8px; font-size: 18px; }
        .detail { margin: 0 auto; width: 80%; }
        .detail th, .detail td { text-align: left; padding: 4px 8px; }
        .title { font-size: 24px; font-weight: bold; margin-bottom: 10px; }
        .section-title { font-size: 16px; font-weight: bold; margin-top: 18px; }
        table { border-collapse: collapse; width: 100%; }
        td, th { border-bottom: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Tiket Kereta</div>
        <div class="badge">{{ $ticket->code ?? '-' }}</div>
    </div>
    <table class="detail">
        <tr><th>ID Tiket</th><td>{{ $ticket->id }}</td></tr>
        <tr><th>Status Booking</th><td>{{ $ticket->booking->status ?? '-' }}</td></tr>
        <tr><th>Harga Tiket</th><td>{{ isset($ticket->booking->schedule->price) ? \App\Helpers\ValidationHelper::formatRupiah($ticket->booking->schedule->price) : '-' }}</td></tr>
        <tr><th>Jumlah Penumpang</th><td>{{ $ticket->booking->passenger_count ?? '-' }}</td></tr>
        <tr><th>Waktu Pemesanan</th><td>{{ $ticket->booking->created_at ? \App\Helpers\ValidationHelper::formatTanggal($ticket->booking->created_at) : '-' }}</td></tr>
        <tr><th>Jadwal Pemberangkatan</th>
            <td>
                {{ $ticket->booking->schedule->date ? \App\Helpers\ValidationHelper::formatTanggal($ticket->booking->schedule->date) : '-' }}
                ({{ $ticket->booking->schedule->departure_time ?? '-' }})<br>
                <strong>Kereta:</strong> {{ $ticket->booking->schedule->train->name ?? '-' }}
            </td>
        </tr>
        <tr><th>Nama Pemesan</th><td>{{ $ticket->booking->user->name ?? '-' }}</td></tr>
        <tr><th>Email Pemesan</th><td>{{ $ticket->booking->user->email ?? '-' }}</td></tr>
    </table>
    <div style="margin-top: 30px; text-align: center; font-size: 12px; color: #888;">
        Dicetak melalui Sistem Informasi Tiket Kereta - {{ date('d-m-Y H:i') }}
    </div>
</body>
</html> 