<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactSendmail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('contact.index', compact('user'));
    }

    public function submit(ContactRequest $request)
    {
        Mail::to($request->email)->send(
            new ContactSendmail(
                [
                    'category' => $request->category,
                    'email' => $request->email,
                    'title' => $request->title,
                    'content' => $request->content,
                ]
            )
        );
        Mail::to('teamstudo.info@gmail.com')->send(
            new ContactSendmail(
                [
                    'category' => $request->category,
                    'email' => $request->email,
                    'title' => $request->title,
                    'content' => $request->content,
                ]
            )
        );

        return view('contact.complete');
    }
}
