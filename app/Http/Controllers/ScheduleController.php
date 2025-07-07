<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = \App\Models\Schedule::all();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $trains = \App\Models\Train::all();
        return view('schedules.create', compact('trains'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'train_id' => 'required|exists:trains,id',
            'date' => 'required|date',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'price' => 'required|numeric|min:0',
        ]);
        \App\Models\Schedule::create($validated);
        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $schedule = \App\Models\Schedule::findOrFail($id);
        $trains = \App\Models\Train::all();
        return view('schedules.edit', compact('schedule', 'trains'));
    }

    public function update(Request $request, $id)
    {
        $schedule = \App\Models\Schedule::findOrFail($id);
        $validated = $request->validate([
            'train_id' => 'required|exists:trains,id',
            'date' => 'required|date',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'price' => 'required|numeric|min:0',
        ]);
        $schedule->update($validated);
        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $schedule = \App\Models\Schedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}
