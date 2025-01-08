<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class WelcomeController extends Controller
{
    public function index()
    {
        $rooms = Room::take(6)->get();
        return view('welcome', compact('rooms'));
    }
}