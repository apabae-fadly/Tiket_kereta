<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Train;
use App\Helpers\UserHelper;
use App\Helpers\ResponseHelper;
use App\Helpers\ValidationHelper;

class TrainController extends Controller
{
    public function index()
    {
        // Cek apakah user adalah admin
        if (!UserHelper::IsAdmin()) {
            return ResponseHelper::forbiddenJson('Akses ditolak. Hanya admin yang diizinkan.');
        }

        $trains = Train::all();
        return view('trains.index', compact('trains'));
    }

    public function create()
    {
        // Cek apakah user adalah admin
        if (!UserHelper::IsAdmin()) {
            return ResponseHelper::errorRedirect('Akses ditolak. Hanya admin yang diizinkan.');
        }

        return view('trains.create');
    }

    public function store(Request $request)
    {
        // Cek apakah user adalah admin
        if (!UserHelper::IsAdmin()) {
            return ResponseHelper::errorRedirect('Akses ditolak. Hanya admin yang diizinkan.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'seat_count' => 'required|integer|min:1',
        ]);

        // Sanitasi input
        $data = [
            'name' => ValidationHelper::sanitizeInput($request->name),
            'type' => ValidationHelper::sanitizeInput($request->type),
            'seat_count' => (int) $request->seat_count,
        ];

        Train::create($data);
        
        return ResponseHelper::successRedirect('Kereta berhasil ditambahkan.', route('trains.index'));
    }

    public function show($id)
    {
        $train = Train::findOrFail($id);
        return view('trains.show', compact('train'));
    }

    public function edit($id)
    {
        // Cek apakah user adalah admin
        if (!UserHelper::IsAdmin()) {
            return ResponseHelper::errorRedirect('Akses ditolak. Hanya admin yang diizinkan.');
        }

        $train = Train::findOrFail($id);
        return view('trains.edit', compact('train'));
    }

    public function update(Request $request, $id)
    {
        // Cek apakah user adalah admin
        if (!UserHelper::IsAdmin()) {
            return ResponseHelper::errorRedirect('Akses ditolak. Hanya admin yang diizinkan.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'seat_count' => 'required|integer|min:1',
        ]);

        $train = Train::findOrFail($id);
        
        // Sanitasi input
        $data = [
            'name' => ValidationHelper::sanitizeInput($request->name),
            'type' => ValidationHelper::sanitizeInput($request->type),
            'seat_count' => (int) $request->seat_count,
        ];

        $train->update($data);
        
        return ResponseHelper::successRedirect('Kereta berhasil diupdate.', route('trains.index'));
    }

    public function destroy($id)
    {
        // Cek apakah user adalah admin
        if (!UserHelper::IsAdmin()) {
            return ResponseHelper::errorRedirect('Akses ditolak. Hanya admin yang diizinkan.');
        }

        $train = Train::findOrFail($id);
        $train->delete();
        
        return ResponseHelper::successRedirect('Kereta berhasil dihapus.', route('trains.index'));
    }
}
