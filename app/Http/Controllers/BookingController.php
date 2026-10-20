<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\MatchComment;
use App\Models\Statistic;
use App\Models\ReservationTerrain;
use App\Models\User;
use App\Mail\MatchCreatedMail;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{

public function store(Request $request)
{
    $user = auth()->user();

    // 🔥 VALIDARE BACKEND
    $request->validate([
    'date' => 'required',
    'start_time' => 'required',
    'terrain_id' => 'required|integer|min:1',
    'people' => 'required_if:create_match,on|nullable|integer|min:1',
], [
    'date.required' => 'Selectează ziua!',
    'start_time.required' => 'Selectează ora!',
    'people.required_if' => 'Introdu numărul de persoane!',
    'terrain_id.required' =>
        'Selectează terenul!',

    'people.required_if' =>
        'Introdu numărul de persoane!',
]);

$exists = Booking::where('reservation_id', $request->reservation_id)

    ->where('terrain_id', $request->terrain_id)

    ->where('date', $request->date)

    ->where(function ($query) use ($request) {

        $query->where(function ($q) use ($request) {

            $q->where('start_time', '<', $request->end_time)
              ->where('end_time', '>', $request->start_time);

        });

    })

    ->exists();

    if ($exists) {

    return back()->withErrors([
        'time' => 'Acest teren este deja rezervat la această oră.'
    ]);
}

    // Booking::create([
    //     'user_id' => $user->id,
    //     'reservation_id' => $request->reservation_id,

    //     'terrain_id' => $request->terrain_id,

    //     'name' => $user->name,
    //     'username' => $user->username,
    //     'email' => $user->email,
    //     'phone' => $user->phone,

    //     'date' => $request->date,
    //     'start_time' => $request->start_time,
    //     'end_time' => $request->end_time,

    //     'is_match' => $request->has('create_match'),
    //     'people' => $request->people,
    //     'details' => $request->details,
    // ]);

    $booking = Booking::create([
    'user_id' => $user->id,
    'reservation_id' => $request->reservation_id,

    'terrain_id' => $request->terrain_id,

    'date' => $request->date,
    'start_time' => $request->start_time,
    'end_time' => $request->end_time,

    'is_match' => $request->has('create_match'),
    'people' => $request->people,
    'details' => $request->details,
]);

if ($booking->is_match) {

    $users = User::where('notify_matches', 1)->get();

    foreach ($users as $user) {

        Mail::to($user->email)
            ->send(new MatchCreatedMail($booking));
    }
}

$stat = Statistic::first();

if (!$stat) {
    $stat = Statistic::create([
        'total_bookings' => 0,
    ]);
}

$stat->increment('total_bookings');

    if ($booking->is_match) {
    return redirect()->route('matches')
        ->with('success', 'Meci creat!');
}

return redirect()->route('my.bookings')
    ->with('success', 'Rezervare creată!');
}
public function myBookings()
{
    $user = auth()->user();

    $bookings = Booking::with(['reservation', 'terrain'])
    ->where('user_id', $user->id)
    ->where(function ($q) {
        $q->where('is_match', false)
          ->orWhereNull('is_match');
    })
    ->latest()
    ->get();

    $myMatches = Booking::with(['reservation', 'participants', 'terrain'])
        ->where('user_id', $user->id)
        ->where('is_match', true)
        ->latest()
        ->get()
        ->unique('id');

    $joinedMatches = Booking::with(['reservation', 'participants', 'terrain'])
        ->whereHas('participants', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->where('user_id', '!=', auth()->id())
        ->latest()
        ->get();

    return view('my-bookings', compact(
        'bookings',
        'myMatches',
        'joinedMatches'
    ));
}
public function matches()
{
    $matches = Booking::with([
        'reservation',
        'participants',
        'terrain'
    ])
    ->where('is_match', true)
    ->latest()
    ->get();

    return view('meciuri', compact('matches'));
}
public function showMatch($id)
{
    $match = \App\Models\Booking::with(['participants.user', 'reservation', 'organizer', 'terrain'])
        ->findOrFail($id);

    return view('meciuri_show', compact('match'));
}
public function joinMatch($id)
{
    $match = \App\Models\Booking::with('participants')->findOrFail($id);

    // 🔥 organizatorul NU are voie
    if ($match->user_id === auth()->id()) {
        return back()->with('error', 'Ești organizatorul și nu te poți înscrie.');
    }

    // 🔥 dacă e full
    if ($match->participants->count() >= $match->people) {
        return back()->with('error', 'Nu mai sunt locuri');
    }

    // 🔥 dacă e deja înscris
    if ($match->participants()->where('user_id', auth()->id())->exists()) {
        return back()->with('error', 'Ești deja înscris');
    }

    $match->participants()->create([
        'user_id' => auth()->id()
    ]);

    return back()->with('success', 'Te-ai înscris!');
}
public function addComment(Request $request, $id)
{
    $request->validate([
        'comment' => 'required|min:2'
    ]);

    MatchComment::create([
        'booking_id' => $id,
        'user_id' => auth()->id(),
        'comment' => $request->comment
    ]);

    return back()->with('success', 'Comentariu adăugat!');
}
public function deleteComment($id)
{
    $comment = MatchComment::findOrFail($id);

    // 🔐 autor SAU admin
    if (
        $comment->user_id !== auth()->id() &&
        auth()->user()->role !== 'admin'
    ) {
        abort(403);
    }

    $comment->delete();

    return back()->with('success', 'Comentariul a fost șters!');
}

public function destroy($id)
{
    $booking = Booking::findOrFail($id);

    // allow ADMIN
    if (
        $booking->user_id !== auth()->id() &&
        auth()->user()->role !== 'admin'
    ) {
        abort(403);
    }

    // dacă este meci → șterge participanții și comentariile
    if ($booking->is_match) {

        $booking->participants()->delete();

        MatchComment::where('booking_id', $booking->id)
            ->delete();
    }

    $booking->delete();

    return back()->with('success',
        $booking->is_match
        ? 'Meciul a fost șters!'
        : 'Rezervarea a fost anulată!'
    );
}
public function leaveMatch($id)
{
    $match = Booking::findOrFail($id);

    $match->participants()
        ->where('user_id', auth()->id())
        ->delete();

    return back()->with('success', 'Ai părăsit meciul!');
}
public function deleteMatch($id)
{
    $match = Booking::findOrFail($id);

    // 🔥 allow ADMIN
    if (
        $match->user_id !== auth()->id() &&
        auth()->user()->role !== 'admin'
    ) {
        abort(403);
    }

    $match->delete();

    return back()->with('success', 'Meci șters!');
}

}
