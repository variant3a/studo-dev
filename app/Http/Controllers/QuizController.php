<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('user_id', Auth::user()->id)->latest()->get();
        return view('user.quiz', compact('quizzes'));
    }

    public function show()
    {

    }
}
