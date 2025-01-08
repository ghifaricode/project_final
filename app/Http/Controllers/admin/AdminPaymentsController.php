<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\PaymentMethod;
use Illuminate\Support\Str;

class AdminPaymentsController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with([
            'reservation' => function($query) {
                $query->select('id', 'user_id', 'total_price')
                    ->with(['user' => function($q) {
                        $q->select('id', 'name');
                    }]);
            },
            'paymentMethod' => function($query) {
                $query->select('id', 'name');
            }
        ])->latest();

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->whereHas('reservation.user', function($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('paymentMethod', function($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                });
            });
        }

        $data = [
            'title' => 'Payment',
            'payments' => $query->paginate(10),
            'reservations' => Reservation::all(),
            'paymentMethods' => PaymentMethod::all()
        ];

        return view('admin.crud.payments', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'reservation_id' => 'required',
            'payment_method_id' => 'required',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'status' => 'required',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $payment = new Payment();
        $payment->reservation_id = $validatedData['reservation_id'];
        $payment->payment_method_id = $validatedData['payment_method_id'];
        $payment->amount = $validatedData['amount'];
        $payment->payment_date = $validatedData['payment_date'];
        $payment->status = $validatedData['status'];

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/payment_img'), $filename);
            $payment->payment_proof = 'images/payment_img/' . $filename;
        }

        $payment->save();

        return redirect()->back()->with('success', 'Payment added successfully');
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,failed'
        ]);

        if ($request->hasFile('payment_proof')) {
            // Hapus gambar lama jika ada
            if ($payment->payment_proof && file_exists(public_path($payment->payment_proof))) {
                unlink(public_path($payment->payment_proof));
            }

            $image = $request->file('payment_proof');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            
            // Pastikan direktori ada
            if (!file_exists(public_path('images/payment_img'))) {
                mkdir(public_path('images/payment_img'), 0777, true);
            }
            
            $image->move(public_path('images/payment_img'), $imageName);
            $validated['payment_proof'] = 'images/payment_img/' . $imageName;
        }

        $payment->update($validated);

        return redirect()->route('admin.payments')->with('success', 'Status pembayaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);

        // Hapus gambar jika ada
        if ($payment->payment_proof && file_exists(public_path($payment->payment_proof))) {
            unlink(public_path($payment->payment_proof));
        }

        $payment->delete();

        return redirect()->route('admin.payments')->with('success', 'Pembayaran berhasil dihapus');
    }

    public function printStruk(Payment $payment)
    {
        $payment->load(['reservation.user', 'paymentMethod']);
        $html = view('admin.pesanan.struk', compact('payment'))->render();
        return response()->json(['html' => $html]);
    }
}
