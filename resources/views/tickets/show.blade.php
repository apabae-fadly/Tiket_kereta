@extends('layouts.app')

@section('content')
<div class="py-5" style="background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%); min-height: 90vh;">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="card shadow-lg rounded-4 glass-card" style="width: 420px;">
            <div class="card-body text-center">
                <div class="mb-3">
                    <span style="font-size: 3rem; color: #4e73df;">
                        <i class="bi bi-ticket-perforated"></i>
                    </span>
                </div>
                <h3 class="mb-3 fw-bold">Detail Tiket</h3>
                <div class="mb-3">
                    <span class="badge bg-primary fs-5 px-4 py-2" style="letter-spacing: 2px;">
                        {{ $ticket->code ?? '-' }}
                    </span>
                </div>
                <ul class="list-group list-group-flush mb-3 text-start">
                    <li class="list-group-item border-0"><strong>ID Tiket:</strong> {{ $ticket->id }}</li>
                    <li class="list-group-item border-0"><strong>Tanggal Terbit:</strong> {{ $ticket->issued_at ? \App\Helpers\ValidationHelper::formatTanggal($ticket->issued_at) : '-' }}</li>
                    <li class="list-group-item border-0"><strong>Booking ID:</strong> {{ $ticket->booking_id }}</li>
                    <li class="list-group-item border-0"><strong>Status Booking:</strong> {{ $ticket->booking->status ?? '-' }}</li>
                    <li class="list-group-item border-0"><strong>Harga Tiket:</strong> {{ isset($ticket->booking->schedule->price) ? \App\Helpers\ValidationHelper::formatRupiah($ticket->booking->schedule->price) : '-' }}</li>
                    <li class="list-group-item border-0"><strong>Jumlah Penumpang:</strong> {{ $ticket->booking->passenger_count ?? '-' }}</li>
                    <li class="list-group-item border-0"><strong>Waktu Pemesanan:</strong> {{ $ticket->booking->created_at ? \App\Helpers\ValidationHelper::formatTanggal($ticket->booking->created_at) : '-' }}</li>
                    <li class="list-group-item border-0"><strong>Jadwal Pemberangkatan:</strong> 
                        {{ $ticket->booking->schedule->date ? \App\Helpers\ValidationHelper::formatTanggal($ticket->booking->schedule->date) : '-' }}
                        ({{ $ticket->booking->schedule->departure_time ?? '-' }})
                        <br><strong>Kereta:</strong> {{ $ticket->booking->schedule->train->name ?? '-' }}
                    </li>
                    <li class="list-group-item border-0"><strong>Nama Pemesan:</strong> {{ $ticket->booking->user->name ?? '-' }}</li>
                    <li class="list-group-item border-0"><strong>Email Pemesan:</strong> {{ $ticket->booking->user->email ?? '-' }}</li>
                </ul>
                <a href="{{ route('tickets.index') }}" class="btn btn-outline-primary rounded-pill px-4 mt-2 btn-animate">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('tickets.download', $ticket->id) }}" class="btn btn-success rounded-pill px-4 mt-2 ms-2 btn-animate">
                    <i class="bi bi-download"></i> Download Tiket (PDF)
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
