<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function create(SubjectRequest $request)
    {
        $subject = new Subject();
        $subject->create_by = Auth::user()->id;
        $subject->category = $request->category;
        $subject->subject_name = $request->subject_name;
        $subject->save();

        return back()->with('status', __('Added Success') . ' : ' . $request->subject_name);
    }

    public function destroy(Request $request)
    {
        $subject = Subject::where('create_by', Auth::user()->id);
        $subject->delete($request->id);

        return redirect('/user/profile')->with('status', __('Delete All') . __('Complete'));
    }
}
