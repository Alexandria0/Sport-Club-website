<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Booking;
use App\Models\User;
use App\Models\MatchComment;
use App\Models\Statistic;


class HomeController extends Controller
{

public function index()
{
    $sports = Reservation::select('sport')->distinct()->get();
    return view('home', compact('sports'));
}
public function despreNoi()
{
    $reservationsCount = Reservation::count();
    $usersCount = User::count();

    $stat = Statistic::first();

    $totalBookings = $stat ? $stat->total_bookings : 0;

    return view('despre-noi', compact(
        'reservationsCount',
        'usersCount',
        'totalBookings'
    ));
}
}
