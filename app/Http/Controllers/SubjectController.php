<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function create(Request $request)
    {
        $subject = new Subject();
        $subject->create_by = Auth::user()->user_id;
        $subject->category = $request->category;
        $subject->subject_name = $request->subject_name;
        $subject->save();
        
        return redirect('user/timer')->with('status', __('Added Success'));
    }
}
