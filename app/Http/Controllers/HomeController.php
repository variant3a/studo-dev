<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Notepad;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\Timer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $timer = Timer::where('user_id', Auth::user()->id)->where('created_at', '>', Carbon::now()->subDay(7))->get();
        $my_quizzes = Quiz::where('user_id', Auth::user()->id)->where('number_of_answers', '>', 0)->orderBy('correct_count', 'asc')->limit(3)->get();
        $global_quizzes = Quiz::where('user_id', '!=', Auth::user()->id)->where('publishing_settings', 1)->where('number_of_answers', '>', 0)->where('correct_count', 0)->latest()->get();

        return view('user.home', compact('timer', 'global_quizzes', 'my_quizzes'));
    }

    public function show()
    {
        $now = Carbon::now()->timestamp;
        $user = User::find(Auth::user()->id);
        $quizzes = Quiz::where('user_id', Auth::user()->id)->get();
        $notes = Notepad::where('user_id', Auth::user()->id)->get();
        $timer = Timer::where('user_id', Auth::user()->id)->get();
        $my_subjects = Subject::where('create_by', Auth::user()->id)->get();

        $started_at = Timer::where('user_id', Auth::user()->id)->sum('started_at');
        $ended_at = Timer::where('user_id', Auth::user()->id)->sum('ended_at');

        $total_study_time = $ended_at - $started_at;

        return view('user.profile', compact('now', 'user', 'quizzes', 'notes', 'timer', 'my_subjects', 'total_study_time'));
    }

    public function update(UserRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        if(isset($request->user_id)) $user->user_id = $request->user_id;
        if(isset($request->email)) $user->email = $request->email;
        $user->save();

        return redirect('/user/profile')->with('status', __('Profile Updated'));
    }

    public function destroy()
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->delete();

        return redirect('/');
    }

}
