<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Middleware\LevelAdmin;
use Illuminate\Support\Facades\Auth;

class AdminUSerController extends Controller
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

        $data = [
            'title' => 'User & Admin',
            'users' => User::latest()->paginate(10),
            'roles' => [1, 2],
        ];

        // Cek autentikasi dan role di methodq
        if (!Auth::check() || Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $request = request();
        if ($request->search) {
            $data['users'] = User::latest()
                ->where(function($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->search . '%')
                          ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                          ->orWhere('phone', 'LIKE', '%' . $request->search . '%');
                })
                ->paginate(10);
        }
        
        return view('admin.crud.user', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|in:1,2',
        ]);

        User::create($validated);
        return redirect()->route('admin.user')->with('success', 'User created successfully');
    }

    public function update(Request $request, $id_user)
    {
        $user = User::find($id_user);
        
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id_user,
            'phone' => 'required|string|max:255|unique:users,phone,'.$id_user,
            'role_id' => 'required|in:1,2',
        ];

        if($request->filled('password')) {
            $rules['password'] = 'required|string|min:8';
        }

        $validated = $request->validate($rules);

        if(!$request->filled('password')) {
            unset($validated['password']);
        }

        $user->update($validated);
        return redirect()->route('admin.user')->with('success', 'User updated successfully');
    }

    public function destroy($id_user)
    {
        User::find(id: $id_user)->delete();
        return redirect()->route('admin.user')->with('success', 'User deleted successfully');
    }
}
