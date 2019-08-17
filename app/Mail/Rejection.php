<?php

namespace App\Mail;

use App\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Rejection extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name= $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('About your SL Application')
            ->from('info@sl.ku.edu.tr', 'SL Team')
            ->view('mail.rejection')->with([
                'request' => $this->name
            ]);
    }
}
