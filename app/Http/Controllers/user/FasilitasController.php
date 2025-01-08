<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FasilitasController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role_id !== 2) {
            return redirect()->route('register');
        }

        $rooms = Room::all();
        return view('fasilitas', compact('rooms'));
    }
}
