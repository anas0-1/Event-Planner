<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Comment;
use App\Models\Rating;

class EventDetailController extends Controller
{
    public function show($id)
    {
        $event = Event::with('user', 'comments.user', 'ratings.user')->findOrFail($id);
        $userRating = $event->userRating;
        return view('events.show', compact('event', 'userRating'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $event = Event::findOrFail($id);

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = auth()->id();
        $event->comments()->save($comment);

        return redirect()->route('events.show', $event->id)->with('success', 'Comment added successfully.');
    }
    public function deleteComment($id)
    {
        // Find the comment
        $comment = Comment::findOrFail($id);

        // Check if the logged-in user is the owner of the comment
        if ($comment->user_id == auth()->id()) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully!');
        }

        return redirect()->back()->with('error', 'Unauthorized action.');
    }
    public function storeRating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $event = Event::findOrFail($id);

        $rating = Rating::updateOrCreate(
            ['user_id' => auth()->id(), 'event_id' => $id],
            ['rating' => $request->rating]
        );

        return redirect()->route('events.show', $event->id)->with('success', 'Rating submitted successfully.');
    }
}
