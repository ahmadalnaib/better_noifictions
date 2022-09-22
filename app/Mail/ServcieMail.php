<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServcieMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->user = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(['email'=>$this->user['email']])
        ->markdown('emails.servicesmail')
        ->with([
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'address' => $this->user['address'],
                'message' => $this->user['message'],
            ]);
    }
}
