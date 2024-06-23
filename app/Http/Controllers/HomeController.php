<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('admin.dashboard', compact('events'));
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Event deleted successfully.');
    }
    public function reservations()
    {
        $reservations = Reservation::with(['user', 'event'])->get();
        return view('admin.reservations', compact('reservations'));
    }

    public function deleteReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->back()->with('success', 'Reservation deleted successfully!');
    }
}
