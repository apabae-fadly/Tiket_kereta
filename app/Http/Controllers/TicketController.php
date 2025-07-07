<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket; // Pastikan Anda mengimpor model Ticket
use Barryvdh\DomPDF\Facade\Pdf;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = \App\Models\Ticket::with(['booking.user', 'booking.schedule.train'])->findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    public function download($id)
    {
        $ticket = \App\Models\Ticket::with(['booking.user', 'booking.schedule.train'])->findOrFail($id);
        $pdf = Pdf::loadView('tickets.pdf', compact('ticket'));
        return $pdf->download('tiket-' . ($ticket->code ?? $ticket->id) . '.pdf');
    }
}
