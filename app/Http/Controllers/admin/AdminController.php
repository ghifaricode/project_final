<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\LevelAdmin;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public static function middleware(): array
    {
        return [
            'auth',
            LevelAdmin::class,
        ];
    }
    
    public function index()
    {
        // Cek autentikasi dan role di method
        if (!Auth::check() || Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $data = [
            'title' => 'Dashboard',
            'totalAdmins' => User::where('role_id', 1)->count(),
            'totalUsers' => User::where('role_id', 2)->count(), 
            'totalRooms' => Room::count(),
            'totalReservasi' => Reservation::count(),
        ];

        // Statistik pemesanan per kamar
        $roomStats = DB::table('reservations')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->select(
                'rooms.name as room_name',
                DB::raw('COUNT(*) as total_bookings'),
                DB::raw('ROUND(COUNT(*) * 100.0 / NULLIF((SELECT COUNT(*) FROM reservations), 0), 1) as percentage')
            )
            ->groupBy('rooms.id', 'rooms.name')
            ->orderBy('total_bookings', 'desc')
            ->get();
        // Trend pemesanan bulanan
        $monthlyStats = DB::table('reservations')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%M %Y') as month"),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month_sort"),
                DB::raw('COUNT(*) as total_bookings')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%M %Y')"), DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy('month_sort', 'asc')
            ->get()
            ->map(function($item) {
                return [
                    'month' => $item->month,
                    'total_bookings' => $item->total_bookings
                ];
            });
        $users = User::all();

        // Tambahkan ini sementara di method index() untuk testing
        if (Reservation::count() === 0) {
            $rooms = Room::all();
            $users = User::where('role_id', 2)->get();
            
            foreach($rooms as $room) {
                for($i = 0; $i < rand(1, 5); $i++) {
                    $randomUser = $users->random();
                    $checkIn = Carbon::now()->addDays(rand(1, 30));
                    $checkOut = Carbon::now()->addDays(rand(31, 60));
                    $totalNights = $checkIn->diffInDays($checkOut);
                    
                    Reservation::create([
                        'room_id' => $room->id,
                        'user_id' => $randomUser->id,
                        'check_in' => $checkIn,
                        'check_out' => $checkOut,
                        'total_guests' => rand(1, 4),
                        'status' => ['pending', 'confirmed', 'cancelled'][rand(0, 2)],
                        'total_price' => $room->price * $totalNights,
                        'created_at' => Carbon::now()->subDays(rand(0, 180)),
                    ]);
                }
            }
        }

        return view('admin.layouts.home', array_merge($data, [
            'roomStats' => $roomStats,
            'monthlyStats' => $monthlyStats
        ]), compact('users'));
    }
}
