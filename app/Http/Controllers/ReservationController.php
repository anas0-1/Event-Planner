<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function reserve(Request $request, Event $event)
    {
        // Validate the request data
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Check if a reservation already exists for this user and event
        $reservation = Reservation::where('user_id', auth()->id())
                                  ->where('event_id', $event->id)
                                  ->first();

        if ($reservation) {
            // Update the existing reservation
            $reservation->quantity = $request->quantity;
            $reservation->save();

            return redirect()->back()->with('success', 'Reservation updated successfully!');
        } else {
            // Create a new reservation
            $reservation = new Reservation();
            $reservation->user_id = auth()->id();
            $reservation->event_id = $event->id;
            $reservation->quantity = $request->quantity;
            $reservation->save();

            return redirect()->back()->with('success', 'Reservation successful!');
        }
    }

    public function deleteReservation(Event $event)
    {
        // Find the reservation for the logged-in user and the event
        $reservation = Reservation::where('user_id', auth()->id())
                                  ->where('event_id', $event->id)
                                  ->first();

        if ($reservation) {
            $reservation->delete();
            return redirect()->back()->with('success', 'Reservation deleted successfully!');
        }

        return redirect()->back()->with('error', 'No reservation found to delete.');
    }
}


