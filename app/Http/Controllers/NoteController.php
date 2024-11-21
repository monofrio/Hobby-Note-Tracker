<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Note;
use App\Models\Plant;


class NoteController extends Controller
{
    public function store(Request $request, Plant $plant)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        // Create a new note associated with the plant and the authenticated user
        $plant->notes()->create([
            'content' => $request->input('content'),
            'user_id' => auth()->id(),  // Set the user_id to the current logged-in user
        ]);

        return redirect()->route('plants.show', $plant)->with('success', 'Note added successfully.');
    }

}
