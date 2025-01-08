<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentMethod;
use App\Http\Middleware\LevelAdmin;

class AdminPaymentsMethodeController extends Controller
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
        if (!Auth::check() || Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $data = [
            'title' => 'Payment Method',
            'payment_methods' => PaymentMethod::latest()->paginate(10),
        ];

        return view('admin.crud.payment_method', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'account_name' => 'required|max:255',
            'account_number' => 'required|max:255'
        ]);

        PaymentMethod::create($validatedData);

        return redirect()->route('admin.payment_method')->with('success', 'Payment method has been added!');
    }

    public function update(Request $request, PaymentMethod $payment_method)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'account_name' => 'required|max:255', 
            'account_number' => 'required|max:255'
        ]);

        PaymentMethod::where('id', $payment_method->id)->update($validatedData);

        return redirect()->route('admin.payment_method')->with('success', 'Payment method has been updated!');
    }

    public function destroy(PaymentMethod $payment_method)
    {
        PaymentMethod::destroy($payment_method->id);
        return redirect()->route('admin.payment_method')->with('success', 'Payment method has been deleted!');
    }
}
