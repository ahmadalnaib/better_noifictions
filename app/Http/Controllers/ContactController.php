<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Mail\ContactMail;


use Illuminate\Http\Request;
use App\Notifications\ContactEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;


class ContactController extends Controller
{
    //

    public function store(Request $request)
    {
        $users = User::all();
        $contacts=Contact::create([
         
            'name'=>$request->name,
             'email'=>$request->email,
             'message'=>$request->message
            
        ]);
        Mail::to('alnaib888@google.com')->send(new ContactMail($contacts));
        Notification::send($users, new ContactEmail($contacts));
        return redirect()->back();
    }
}
