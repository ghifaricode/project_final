<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class ReservasiController extends Controller
{
    public function index(Request $request)
    {
        $rooms = Room::all();
        $selectedRoom = $request->query('selected_room');
        return view('reservasi', compact('rooms', 'selectedRoom'));
    }

    public function store(Request $request)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah user memiliki role_id = 2 (user biasa)
        if (Auth::user()->role_id !== 2) {
            return redirect()->route('register');
        }

        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today', 
            'check_out' => 'required|date|after:check_in',
            'total_guests' => 'required|integer|min:1',
        ]);

        // Cek ketersediaan kamar
        $isRoomAvailable = $this->checkRoomAvailability(
            $request->room_id,
            $request->check_in,
            $request->check_out
        );

        if (!$isRoomAvailable) {
            return back()->with('error', 'Kamar tidak tersedia untuk tanggal yang dipilih');
        }

        // Hitung total hari
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $totalDays = $checkOut->diffInDays($checkIn);

        // Ambil harga kamar
        $room = Room::findOrFail($request->room_id);

        // Hitung total harga
        $totalPrice = $room->price * $totalDays;

        // Buat reservasi
        $reservation = Reservation::create([
            'user_id' => Auth::user()->id,
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_guests' => $request->total_guests,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'notes' => $request->notes
        ]);

        return redirect()->route('status-reservasi')
            ->with('success', 'Reservasi berhasil dibuat. Silahkan lakukan pembayaran.');
    }

    public function status()
    {
        $reservations = Reservation::where('user_id', Auth::user()->id)
            ->with(['room', 'payment'])
            ->latest()
            ->get();

        $paymentMethods = PaymentMethod::all();

        return view('statusreservasi', compact('reservations', 'paymentMethods'));
    }

    public function uploadPayment(Request $request, Reservation $reservation)
    {
        $request->validate([
            'payment_proof' => 'required|image|max:2048',
            'payment_method_id' => 'required|exists:payment_methods,id'
        ]);

        // Cek apakah reservasi milik user yang login
        if ($reservation->user_id !== Auth::user()->id) {
            abort(403);
        }

        // Cek apakah sudah ada pembayaran sebelumnya
        if ($reservation->payment) {
            return back()->with('error', 'Bukti pembayaran sudah diupload sebelumnya');
        }

        $image = $request->file('payment_proof');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/payment_img'), $imageName);
        $path = 'images/payment_img/' . $imageName;

        Payment::create([
            'reservation_id' => $reservation->id,
            'payment_method_id' => $request->payment_method_id,
            'payment_date' => now(),
            'amount' => $reservation->total_price,
            'payment_proof' => $path,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diupload');
    }

    public function cancel(Reservation $reservation)
    {
        // Cek apakah reservasi milik user yang login
        if ($reservation->user_id !== Auth::user()->id) {
            abort(403);
        }

        // Cek apakah reservasi masih bisa dibatalkan
        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Reservasi tidak dapat dibatalkan');
        }

        $reservation->update(['status' => 'cancelled']);

        // Hapus bukti pembayaran jika ada
        if ($reservation->payment && $reservation->payment->payment_proof) {
            Storage::disk('public')->delete($reservation->payment->payment_proof);
            $reservation->payment->delete();
        }

        return back()->with('success', 'Reservasi berhasil dibatalkan');
    }

    private function checkRoomAvailability($roomId, $checkIn, $checkOut)
    {
        $existingReservations = Reservation::where('room_id', $roomId)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out', [$checkIn, $checkOut])
                    ->orWhere(function ($q) use ($checkIn, $checkOut) {
                        $q->where('check_in', '<=', $checkIn)
                            ->where('check_out', '>=', $checkOut);
                    });
            })
            ->exists();

        return !$existingReservations;
    }
}
