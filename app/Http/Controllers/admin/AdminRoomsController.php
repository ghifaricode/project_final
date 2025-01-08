<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\LevelAdmin;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use Illuminate\Support\Facades\File;

class AdminRoomsController extends Controller
{
    public static function middleware(): array
    {
        return [
            'auth',
            LevelAdmin::class,
        ];
    }

    public function index(Request $request)
    {
        // Cek autentikasi dan role di method
        if (!Auth::check() || Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $data = [
            'title' => 'Room',
            'rooms' => Room::latest()->paginate(10),
        ];

        if ($request->has('search')) {
            $data['rooms'] = Room::where('name', 'like', '%' . $request->search . '%')->paginate(10);
        }

        return view('admin.crud.rooms', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Hapus titik dan angka di belakang titik
        $price = $request->price;
        if (strpos($price, '.') !== false) {
            $price = substr($price, 0, strpos($price, '.'));
        }
        $validated['price'] = $price;

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/room_img'), $imageName);

        $validated['image'] = $imageName;

        Room::create($validated);

        return redirect()->route('admin.rooms')->with('success', 'Room created successfully');
    }

    public function update(Request $request, $id_room)
    {
        $room = Room::findOrFail($id_room);

        $rules = [
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        try {
            $validated = $request->validate($rules);

            // Hapus titik dan angka di belakang titik
            $price = $request->price;
            if (strpos($price, '.') !== false) {
                $price = substr($price, 0, strpos($price, '.'));
            }
            $validated['price'] = $price;

            if ($request->hasFile('image')) {
                if ($room->image && File::exists(public_path('images/room_img/' . $room->image))) {
                    File::delete(public_path('images/room_img/' . $room->image));
                }
                
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images/room_img'), $imageName);
                $validated['image'] = $imageName;
            }

            $updated = $room->update($validated);

            if ($updated) {
                return redirect()
                    ->route('admin.rooms')
                    ->with('success', 'Room berhasil diupdate');
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Gagal mengupdate room')
                    ->withInput();
            }

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        // Hapus gambar
        if (File::exists(public_path('images/room_img/' . $room->image))) {
            File::delete(public_path('images/room_img/' . $room->image));
        }

        $room->delete();

        return redirect()->route('admin.rooms')->with('success', 'Room deleted successfully');
    }
}
