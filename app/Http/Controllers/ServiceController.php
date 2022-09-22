<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Mail\ContactMail;
use App\Mail\ServcieMail;
use Illuminate\Http\Request;
use App\Notifications\ServiceEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ServiceController extends Controller
{
    //

    public function store(Request $request)
    {
        $users = User::all();
        $services=Service::create([
         
            'name'=>$request->name,
             'email'=>$request->email,
             'message'=>$request->message,
             'address'=>$request->address
            
        ]);
        Mail::to('alnaib888@google.com')->send(New ServcieMail($services));
        // send(new ServiceMail($contacts));
        Notification::send($users, new ServiceEmail($services));
        return redirect()->back();
    }
}
