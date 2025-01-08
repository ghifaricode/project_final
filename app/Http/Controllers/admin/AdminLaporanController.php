<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminLaporanController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }

        // Mengambil data untuk laporan
        $data = [
            'title' => 'Laporan',
            'users' => User::all(),
            'rooms' => Room::all(),
            'reservations' => Reservation::with(['user', 'room'])->get(),
            'payments' => Payment::with(['reservation', 'paymentMethod'])->get(),
            'payment_methods' => PaymentMethod::all(),
            
            // Statistik umum
            'total_users' => User::count(),
            'total_rooms' => Room::count(),
            'total_reservations' => Reservation::count(),
            'total_payments' => Payment::count(),
            
            // Pendapatan per bulan - Perbaikan query dengan status 'confirmed'
            'monthly_income' => Payment::select(
                DB::raw('DATE_FORMAT(created_at, "%M %Y") as month'),
                DB::raw('MONTH(created_at) as month_num'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COALESCE(SUM(amount), 0) as total_amount')
            )
            ->where('status', 'confirmed')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%M %Y")'), 'month_num', 'year')
            ->orderBy('year', 'desc')
            ->orderBy('month_num', 'desc')
            ->get(),
            
            // Kamar paling populer
            'popular_rooms' => Room::withCount('reservations')
                ->orderBy('reservations_count', 'desc')
                ->get(),
                
            // Status reservasi
            'reservation_status' => Reservation::select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get(),
                
            // Metode pembayaran yang paling sering digunakan
            'payment_methods_usage' => PaymentMethod::withCount('payments')
                ->orderBy('payments_count', 'desc')
                ->get()
        ];

        return view('admin.crud.laporan', $data);
    }
    
    public function generatePDF()
    {
        // Logika untuk generate PDF bisa ditambahkan di sini
        $data = $this->index()->getData();
        
        // Return PDF view atau download
        return view('admin.laporan.pdf', $data);
    }
}
