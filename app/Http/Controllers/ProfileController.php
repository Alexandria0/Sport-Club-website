<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

use App\Models\Booking;
use App\Models\MatchParticipant;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    $validated = $request->validated();

    // AVATAR
    if ($request->hasFile('avatar')) {

        $file = $request->file('avatar');
        $filename = time().'_'.$file->getClientOriginalName();

        $file->storeAs('avatars', $filename, 'public');

        $validated['avatar'] = 'avatars/'.$filename;
    }

    // SHOW ACTIVITY (CORECT & SAFE)
    $validated['show_activity'] = $request->has('show_activity');
    $validated['notify_matches'] = $request->has('notify_matches');

    // EMAIL RESET
    if (isset($validated['email']) && $validated['email'] !== $user->email) {
        $user->email_verified_at = null;
    }

    // SAVE SINGLE FLOW
    $user->fill($validated);
    $user->save();

    return Redirect::route('profile.edit')
        ->with('status', 'profile-updated');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
public function show()
{
    $user = auth()->user();

    $bookings = Booking::with(['reservation', 'terrain'])
        ->where('user_id', $user->id)
        ->latest()
        ->get();

    $myMatches = Booking::with(['reservation', 'terrain', 'participants'])
        ->where('user_id', $user->id)
        ->where('is_match', true)
        ->latest()
        ->get();

    $participations = MatchParticipant::with(['booking.reservation', 'booking.terrain'])
        ->where('user_id', $user->id)
        ->get();

    return view('profile.show', compact(
        'user',
        'bookings',
        'myMatches',
        'participations'
    ));
}

public function showUser($id)
{
    $user = \App\Models\User::findOrFail($id);

    $bookings = $user->bookings()
    ->with(['reservation', 'terrain'])
    ->where('is_match', true)
    ->latest()
    ->get();

    $participations = $user->matchParticipants()
    ->with(['booking.reservation', 'booking.user', 'booking.terrain'])
    ->latest()
    ->get();

    return view('profile.show-user', compact('user', 'bookings', 'participations'));
}
public function deleteAvatar(Request $request): RedirectResponse
{
    $user = $request->user();

    if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
        Storage::disk('public')->delete($user->avatar);
    }

    $user->avatar = null;
    $user->save();

    return Redirect::route('profile.edit')
        ->with('status', 'avatar-deleted');
}

}
