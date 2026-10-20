<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Booking;
use App\Models\ReservationImage;
use Illuminate\Support\Facades\Storage;
use App\Models\MatchParticipant;
use App\Models\ReservationTerrain;
use App\Models\User;


class ReservationController extends Controller
{

public function index()
{

    $reservations = Reservation::with([
    'images',
    'terrains'
])->latest()->get();

    return view('rezervari', compact('reservations'));
}

public function create()
{
    return view('rezervari_create');
}
public function edit(Reservation $reservation)
{
    if(auth()->user()->role !== 'admin'){
        abort(403);
    }

    $reservation->load([
        'images',
        'terrains'
    ]);

    return view(
        'rezervari_edit',
        compact('reservation')
    );
}

public function store(Request $request)
{
    $request->validate([

        'title' => 'required',
        'sport' => 'required',
        'sector' => 'required|string|max:255',
        'address' => 'required',

        'details' => 'required',

        'working_days' => 'required|array',

        'start_time' => 'required',
        'end_time' => 'required|after:start_time',

        'images' => 'required',
        'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',

        'background_image' => 'required|image',

        'terrains' => 'required|array',
        'terrains.*.*.name' => 'required',
'terrains.*.*.price' => 'required|numeric|min:0',
'terrains.*.*.size' => 'required',

    ], [

        'title.required' => 'Introdu denumirea.',
        'sport.required' => 'Introdu sportul.',

        'sector.required' => 'Selectează sectorul.',

        'address.required' => 'Introdu adresa.',

        'details.required' => 'Introdu detalii.',

        'working_days.required' => 'Selectează cel puțin o zi.',

        'start_time.required' => 'Selectează ora de început.',

        'end_time.required' =>
            'Selectează ora de sfârșit.',

        'end_time.after' =>
            'Ora de sfârșit trebuie să fie după ora de început.',

        'images.required' =>
            'Adaugă cel puțin o imagine.',

        'background_image.required' =>
            'Adaugă imaginea de background.',

        'terrains.required' =>
            'Adaugă minim un teren.',

        'terrains.*.*.price.required' =>
'Completează prețul terenului.',

'terrains.*.*.price.numeric' =>
'Prețul trebuie să fie număr.',

'terrains.*.*.price.min' =>
'Prețul nu poate fi negativ sau mai mic decât 0.',

'terrains.*.*.size.required' =>
'Completează dimensiunea terenului.',
    ]);

    if (
        !$request->hasFile('images') ||
        count($request->file('images')) < 1
    ) {
        return back()->withErrors([
            'images' => 'Minim 1 imagine'
        ]);
    }

    $reservation = Reservation::create([

        'title' => $request->title,

        'sport' => $request->sport,

        'sector' => $request->sector,

        'address' => $request->address,

        'details' => $request->details,

        'working_days' => $request->working_days,

        'start_time' => $request->start_time,

        'end_time' => $request->end_time,

        'background_image' =>
            $request->file('background_image')
            ->store('bg', 'public')

    ]);

    // SALVARE TERENURI
    if($request->has('terrains')){

    foreach($request->terrains as $type => $terrains){

        foreach($terrains as $terrain){

            $reservation->terrains()->create([

                'terrain_type' => $type,

                'name' => $terrain['name'],

                'price' => $terrain['price'],

                'size' => $terrain['size'],
            ]);
        }
    }
}

    // GALERIE
    foreach ($request->file('images') as $img) {

        $reservation->images()->create([

            'image' => $img->store('gallery', 'public')

        ]);
    }

    return redirect()
        ->route('rezervari')
        ->with('success', 'Adăugat!');
}
public function despreNoi()
{
    $reservationsCount = Reservation::count();
    $usersCount = User::count();

    return view('despre-noi', compact(
        'reservationsCount',
        'usersCount'
    ));
}

public function show($id)
{

    $bookings = Booking::where('reservation_id', $id)->get();

    $reservation = Reservation::with([
    'images',
    'terrains'
])->findOrFail($id);

    return view('rezervari_show', compact('reservation', 'bookings'));
}
public function update(Request $request, Reservation $reservation)
{
    $validated = $request->validate([

        'title' => 'required',

        'sport' => 'required',

        'sector' => 'required',

        'address' => 'required',

        'details' => 'required',

        'working_days' => 'required|array',

        'start_time' => 'required',

        'end_time' => 'required|after:start_time',

        'images.*' => 'image|max:5000',

        'background_image' => 'nullable|image',

        'terrains' => 'required|array',

        'terrains.*.*.name' => 'required',
        'terrains.*.*.price' => 'required|numeric|min:0',
        'terrains.*.*.size' => 'required',

    ], [

        'title.required' => 'Introdu denumirea.',

        'sport.required' => 'Introdu sportul.',

        'sector.required' => 'Selectează sectorul.',

        'address.required' => 'Introdu adresa.',

        'details.required' => 'Introdu detaliile.',

        'working_days.required' =>
            'Selectează cel puțin o zi.',

        'start_time.required' =>
            'Selectează ora de început.',

        'end_time.required' =>
            'Selectează ora de sfârșit.',

        'end_time.after' =>
            'Ora de sfârșit trebuie să fie după ora de început.',

        'terrains' => 'required|array',

        'terrains.*.*.price' => 'required|numeric|min:0',
        'terrains.*.*.size' => 'required',
        'terrains.*.*.price.min' =>
'Prețul nu poate fi negativ sau mai mic decât 0.',
    ]);

    $reservation->update([

        'title' => $request->title,

        'sport' => $request->sport,

        'sector' => $request->sector,

        'address' => $request->address,

        'details' => $request->details,

        'working_days' => $request->working_days,

        'start_time' => $request->start_time,

        'end_time' => $request->end_time,
    ]);

    // background nou
    if($request->hasFile('background_image')){

        $bg = $request->file('background_image')
            ->store('backgrounds', 'public');

        $reservation->update([
            'background_image' => $bg
        ]);
    }

    // ȘTERGE TERENURILE VECHI
    $reservation->terrains()->delete();

    // ADAUGĂ TERENURILE NOI
    foreach($request->terrains as $type => $terrains){

        foreach($terrains as $terrain){

            $reservation->terrains()->create([

                'terrain_type' => $type,

                'name' => $terrain['name'],

                'price' => $terrain['price'],

                'size' => $terrain['size'],
            ]);
        }
    }

    // imagini noi
    if ($request->file('images')) {

        foreach ($request->file('images') as $file) {

            if ($file->isValid()) {

                $path = $file->store(
                    'gallery',
                    'public'
                );

                $reservation->images()->create([
                    'image' => $path
                ]);
            }
        }
    }

    return redirect()
        ->route('rezervari.show', $reservation->id)
        ->with(
            'success',
            'Rezervarea a fost actualizată!'
        );
}
public function deleteImage(ReservationImage $image)
{
    Storage::disk('public')->delete($image->image);

    $image->delete();

    return response()->json([
        'success' => true
    ]);
}
public function home()
{
    $sports = Reservation::select('sport')->distinct()->get();

    return view('home', compact('sports'));
}
public function destroy($id)
{
    $reservation = Reservation::with('images')
        ->findOrFail($id);

    // șterge gallery
    foreach($reservation->images as $image){

        Storage::disk('public')
            ->delete($image->image);
    }

    // șterge background
    if($reservation->background_image){

        Storage::disk('public')
            ->delete($reservation->background_image);
    }

    $reservation->delete();

    return redirect()
        ->route('rezervari')
        ->with(
            'success',
            'Rezervarea a fost ștearsă!'
        );
}
public function toate()
{
    // 🔹 rezervări normale
    $bookings = Booking::with(['reservation', 'user'])
        ->where('is_match', 0)
        ->latest()
        ->get();

    // 🔥 meciuri (TOT DE AICI VIN!)
    $matches = Booking::with(['reservation', 'user', 'participants'])
        ->where('is_match', 1)
        ->latest()
        ->get();

    return view('rezervari-toate', compact('bookings', 'matches'));
}
}