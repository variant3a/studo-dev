<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notepad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotepadController extends Controller
{
    public function index()
    {
        $notes = Notepad::where('user_id', Auth::user()->id)->get();
        return view('user.notepad', compact('notes'));
    }

    public function show()
    {
        return view('user.notepad');
    }

    public function create(Request $request)
    {
        $note = new Notepad;
        $note->user_id = Auth::user()->id;
        $note->title = $request->title;
        $note->content = $request->content;
        $note->status = false;
        $note->view_count = 0;
        $note->save();

        return redirect('/user/notepad');
    }

}
