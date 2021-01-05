<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notepad;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotepadController extends Controller
{
    public function index(Request $request)
    {
        $search_keyword = $request->input('search-keyword');
        $search_subject = $request->input('search-subject');
        
        $notes = Notepad::where('user_id', Auth::user()->id)->subjectFilter($search_keyword)->keywordFilter($search_subject)->latest()->paginate(10);
        $subjects = Subject::where('create_by', null)->orWhere('create_by', Auth::user()->user_id)->orderBy('subject_name', 'asc')->get();
        
        return view('user.notepad.index', compact('notes'), compact('subjects'));
    }

    public function show($id)
    {
        $note = Notepad::findOrFail($id);
        $note->timestamps = false;
        $note->increment('view_count');
        return view('user.notepad.details', compact('note'));
    }

    public function create(Request $request)
    {
        $note = new Notepad;
        $note->user_id = Auth::user()->id;
        $note->title = $request->title;
        $note->subject_name = $request->subjects;
        $note->content = $request->content;
        $note->view_count = 0;
        $note->save();

        return redirect('/user/notepad/index')->with('status', __('Created'));
    }

    public function edit($id)
    {
        $note = Notepad::findOrFail($id);
        return view('user.notepad.edit', compact('note'));
    }

    public function update(Request $request, $id)
    {
        $note = Notepad::find($id);
        if(isset($request->title)) $note->title = $request->title;
        $note->content = $request->content;
        $note->save();

        return redirect('/user/notepad/' . $id . '/details')->with('status', __('Updated'));
    }

    public function destroy($id)
    {
        $note = Notepad::find($id);
        $note->delete();
        return redirect('/user/notepad/index')->with('status', __('Delete Confirmed'));
    }

}
