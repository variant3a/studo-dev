<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timer;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimerController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function index()
    {
        $subjects = Subject::where('create_by', null)->orWhere('create_by', Auth::user()->user_id)->orderBy('subject_name', 'asc')->get();
        $timer = Timer::where('user_id', Auth::user()->id);
        if($timer === null) return view('user.timer', compact('subjects'));
        $timer = $timer->latest()->get();
        return view('user.timer', compact('timer'), compact('subjects'));
    }

    public function ajaxCreate(Request $request)
    {
        $timer = new Timer;
        $timer->user_id = Auth::user()->id;
        $timer->subject_name = $request->subject_name;
        $timer->started_at = $request->started_at;
        $timer->ended_at = $request->ended_at;
        $timer->save();
        $timer = Timer::where('user_id', Auth::user()->id)->latest()->first('id');
        return response($timer);
    }

    public function destroy(Request $request)
    {
        $timer = Timer::findOrFail($request->id);
        $timer->delete();
    }
}
