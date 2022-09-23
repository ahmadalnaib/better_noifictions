<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\SendMail;
use App\Models\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    //

    public function index()
    {
        return view('sendemail');
    }

    public function mail(Request $request)
    {

        $data=SendEmail::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'link'=>$request->link
        ]);
      

    $users=User::all();
       foreach ($users as $recipient) {
        Mail::to($recipient)->send(new SendMail($data));
    }
       return 'Email was sent';
    }
}
