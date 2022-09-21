<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;


use App\Notifications\ContactEmail;
use Illuminate\Support\Facades\Notification;


class ContactController extends Controller
{
    //

    public function store(Request $request)
    {
        $userSchema = User::all();
        $contacts=Contact::create([
         
            'name'=>$request->name,
             'email'=>$request->email,
             'message'=>$request->message
            
        ]);
        Notification::send($userSchema, new ContactEmail($contacts));
        return redirect()->back();
    }
}
