<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Room;
use App\Models\Reservation;

class UserController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role_id !== 2) {
            return redirect()->route('register');
        }

        $user = Auth::user();
        $rooms = Room::all();
        $reservations = Reservation::where('user_id', Auth::user()->id)
            ->with('room')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('user', 'rooms', 'reservations'));
    }
}