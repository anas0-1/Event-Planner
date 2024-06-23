<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Get the events created by the logged-in user
        $events = Event::where('user_id', Auth::id())->get();

        return view('dashboard', compact('events'));
    }

    public function destroy(Event $event)
    {
        // Check if the logged-in user is the creator of the event
        if ($event->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $event->delete();

        return redirect()->route('dashboard')->with('success', 'Event deleted successfully.');
    }
}
