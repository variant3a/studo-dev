<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $global_quizzes = Quiz::where('publishing_settings', 1)->latest()->paginate(30);
        $my_quizzes = Quiz::where('user_id', Auth::user()->id)->latest()->get();
        return view('user.quiz.index', compact('my_quizzes', 'global_quizzes'));
    }

    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('user.quiz.details', compact('quiz'));
    }

    public function createView()
    {
        $subjects = Subject::where('create_by', null)->orWhere('create_by', Auth::user()->user_id)->orderBy('subject_name', 'asc')->get();
        return view('user.quiz.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        if ($request->publishing_settings == 1) {
            $publishing_settings = 1;
        } else {
            $publishing_settings = 0;
        }
        $sbrkt = mb_strpos($request->content, '[');
        $ebrkt = mb_strpos($request->content, ']');
        $sbrkt_count = mb_substr_count($request->content, '[');
        $ebrkt_count = mb_substr_count($request->content, ']');
        if($sbrkt_count == $ebrkt_count && $sbrkt < $ebrkt) {
            $number_of_answers = $sbrkt_count;
        } else {
            $number_of_answers = 0;
        }
        $quiz = new Quiz;
        $quiz->user_id = Auth::user()->id;
        $quiz->title = $request->title;
        $quiz->publishing_settings = $publishing_settings;
        $quiz->subject_name = $request->subjects;
        $quiz->question = $request->content;
        $quiz->number_of_answers = $number_of_answers;
        $quiz->attempt_count = 0;
        $quiz->correct_count = 0;
        $quiz->save();

        return redirect('/user/quiz/index');
    }

    public function destroy($id)
    {
        $quiz = Quiz::find($id);
        $quiz->delete();
        return redirect('/user/quiz/index')->with('status', __('Delete Confirmed'));
    }

}
