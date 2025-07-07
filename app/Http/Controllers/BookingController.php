<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Ticket;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = \App\Models\Booking::with(['schedule.train', 'user'])->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create(Request $request)
    {
        $schedule = Schedule::with('train')->findOrFail($request->schedule_id);
        return view('bookings.create', compact('schedule'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'passenger_count' => 'required|integer|min:1',
        ]);
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'schedule_id' => $request->schedule_id,
            'passenger_count' => $request->passenger_count,
            'status' => 'Menunggu',
        ]);
        return redirect()->route('bookings.show', $booking->id)->with('success', 'Booking berhasil, menunggu konfirmasi admin.');
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        if (auth()->user()->IsAdmin()) {
            $booking->status = $request->status;
            $booking->save();
            // Jika dikonfirmasi, generate tiket
            if ($booking->status === 'Dikonfirmasi' && !$booking->ticket) {
                Ticket::create([
                    'booking_id' => $booking->id,
                    'code' => strtoupper(Str::random(8)),
                    'issued_at' => now(),
                ]);
            }
            return redirect()->route('bookings.index')->with('success', 'Status booking diperbarui.');
        }
        return back();
    }

    public function bayar(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->user_id != auth()->id()) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);
        $file = $request->file('payment_proof');
        $filename = 'bukti_' . $booking->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/payment_proofs', $filename);
        $booking->payment_proof = $filename;
        $booking->payment_status = 'Menunggu Konfirmasi';
        $booking->save();
        return redirect()->route('bookings.show', $booking->id)->with('success', 'Bukti pembayaran berhasil diupload, menunggu konfirmasi admin.');
    }

    public function konfirmasiPembayaran($id)
    {
        $booking = Booking::findOrFail($id);
        if (!auth()->user()->IsAdmin()) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }
        $booking->payment_status = 'Sudah Dibayar';
        $booking->status = 'Dikonfirmasi';
        $booking->save();
        // Generate tiket jika belum ada
        if (!$booking->ticket) {
            Ticket::create([
                'booking_id' => $booking->id,
                'code' => strtoupper(Str::random(8)),
                'issued_at' => now(),
            ]);
        }
        return redirect()->route('bookings.show', $booking->id)->with('success', 'Pembayaran dikonfirmasi & tiket diterbitkan.');
    }
}
