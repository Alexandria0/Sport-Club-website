<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\ReservationImage;
use Illuminate\Support\Facades\Storage;

class ReservationImageController extends Controller
{
    // ADAUGĂ IMAGINI LA O REZERVARE
    public function store(Request $request, $reservationId)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $reservation = Reservation::findOrFail($reservationId);

        foreach ($request->file('images') as $img) {
            $path = $img->store('gallery', 'public');

            $reservation->images()->create([
                'image' => $path
            ]);
        }

        return back()->with('success', 'Imaginile au fost adăugate!');
    }

    // ȘTERGE O IMAGINE DIN GALERIE
    public function destroy($id)
    {
        $image = ReservationImage::findOrFail($id);

        // șterge fișierul din storage
        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return response()->json([
    'success' => true
]);
    }
}
