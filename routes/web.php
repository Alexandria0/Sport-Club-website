<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ForgotPasswordController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

/*
|--------------------------------------------------------------------------
| User Dashboard
|--------------------------------------------------------------------------
*/

// Route::middleware(['auth', 'verified'])->group(function () {

//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');

// });

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/despre-noi', [HomeController::class, 'despreNoi'])
    ->name('despre-noi');

// Route::view('/home', 'home');

Route::view('/rezervari', 'rezervari');
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationImageController;

// toți văd
Route::get('/rezervari', [ReservationController::class, 'index'])->name('rezervari');
Route::get('/rezervari/create', [ReservationController::class, 'create'])
    ->name('rezervari.create');

// doar admin adaugă
Route::post('/rezervari', [ReservationController::class, 'store'])
    ->middleware(['auth', 'admin']);

Route::view('/meciuri', 'meciuri');

Route::view('/contacte', 'contacte');

Route::post('/reservations/{id}/images', [ReservationImageController::class, 'store'])
    ->name('reservation.images.store');

Route::delete('/reservation-images/{id}', [ReservationImageController::class, 'destroy'])
    ->name('reservation.images.destroy');
    Route::get('/rezervari/{id}', [ReservationController::class, 'show'])
    ->name('rezervari.show');

use App\Http\Controllers\BookingController;

Route::post('/bookings', [BookingController::class, 'store'])
    ->name('bookings.store')
    ->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/rezervarile-mele', [BookingController::class, 'myBookings'])
        ->name('bookings.my');

});
Route::middleware(['auth'])->group(function () {

    Route::get('/rezervari/{reservation}/edit',
        [ReservationController::class, 'edit']
    )->name('rezervari.edit');

});

Route::middleware(['auth'])->group(function () {

    Route::get(
        '/rezervari/{reservation}/edit',
        [ReservationController::class, 'edit']
    )->name('rezervari.edit');

    Route::put(
        '/rezervari/{reservation}',
        [ReservationController::class, 'update']
    )->name('rezervari.update');

});
// LISTA MECIURI
Route::get('/meciuri', [BookingController::class, 'matches'])
    ->name('matches');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])
    ->name('profile.delete-avatar');

// DETALII MECI
Route::get('/meciuri/{id}', [BookingController::class, 'showMatch'])
    ->name('matches.show');

// INSCRIERE DIRECTĂ (fără pagină)
Route::post('/meciuri/{id}/join', [BookingController::class, 'joinMatch'])
    ->name('matches.join')
    ->middleware('auth');

    Route::post('/meciuri/{id}/comment', [BookingController::class, 'addComment'])
    ->name('matches.comment')
    ->middleware('auth');

    Route::delete('/comentarii/{id}', [BookingController::class, 'deleteComment'])
    ->name('matches.comment.delete')
    ->middleware('auth');

Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])
    ->name('bookings.delete')
    ->middleware('auth');
    
    Route::delete('/meciuri/{id}/delete', [BookingController::class, 'deleteMatch'])
    ->name('matches.delete')
    ->middleware('auth');

    Route::delete('/meciuri/{id}/leave', [BookingController::class, 'leaveMatch'])
    ->name('matches.leave')
    ->middleware('auth');

    // profilul meu
Route::get('/profil', [ProfileController::class, 'show'])
    ->name('profile.show')
    ->middleware('auth');

// profil alt user
Route::get('/user/{id}', [ProfileController::class, 'showUser'])
    ->name('profile.show.user');

// pagina rezervări
Route::get('/rezervari', [ReservationController::class, 'index'])
    ->name('rezervari');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])
    ->name('my.bookings');

    Route::delete('/reservation-images/{id}', [ReservationImageController::class, 'destroy'])
    ->name('reservation-images.destroy');
    // Route::get('/home', function () {
    // $sports = Reservation::select('sport')->distinct()->get();
    // return view('home', compact('sports'));

// });

// Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::delete('/rezervari/{id}', [ReservationController::class, 'destroy'])
    ->name('rezervari.destroy');
    Route::get('/loading', function () {
    return view('loading');
})->name('loading');

    Route::get('/rezervari-toate', [ReservationController::class, 'toate'])
    ->name('rezervari.toate')
    ->middleware('auth');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])
    ->name('bookings.delete');

Route::delete('/matches/{id}', [MatchController::class, 'destroy'])
    ->name('matches.delete');
//     Route::get('/profile', [ProfileController::class, 'show'])
//     ->name('profile.show');

// Route::get('/profile/{id}', [ProfileController::class, 'showUser'])
//     ->name('profile.show-user');


require __DIR__.'/auth.php';