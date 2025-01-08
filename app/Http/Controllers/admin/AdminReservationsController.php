<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;

class AdminReservationsController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check() || Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $data = [
            'title' => 'Reservation',
            'reservations' => Reservation::with(['user' => function($query) {
                    $query->select('id', 'name');
                }, 'room' => function($query) {
                    $query->select('id', 'name'); 
                }])
                ->latest()
                ->paginate(10),
            'rooms' => Room::all(),
            'users' => User::where('role_id', 2)->get()
        ];

        if ($request->has('search')) {
            $data['reservations'] = Reservation::whereHas('user', function($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('room', function($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->paginate(10);
        }

        return view('admin.crud.reservation', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'total_guests' => 'required|integer',
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        // Ambil data room
        $room = Room::findOrFail($request->room_id);
        
        // Hitung jumlah hari
        $checkIn = strtotime($request->check_in);
        $checkOut = strtotime($request->check_out);
        $daysCount = ceil(($checkOut - $checkIn) / (60 * 60 * 24));

        // Hitung total harga
        $validated['total_price'] = $room->price * $daysCount;

        Reservation::create($validated);

        return redirect()->route('admin.reservation')->with('success', 'Reservasi berhasil dibuat');
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id', 
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'total_guests' => 'required|integer',
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        try {
            // Ambil data room
            $room = Room::findOrFail($request->room_id);
            
            // Hitung jumlah hari
            $checkIn = strtotime($request->check_in);
            $checkOut = strtotime($request->check_out);
            $daysCount = ceil(($checkOut - $checkIn) / (60 * 60 * 24));

            // Hitung total harga
            $validated['total_price'] = $room->price * $daysCount;

            $reservation->update($validated);
            return redirect()
                ->route('admin.reservation')
                ->with('success', 'Reservasi berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()
            ->route('admin.reservation')
            ->with('success', 'Reservasi berhasil dihapus');
    }
}
