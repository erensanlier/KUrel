<?php

namespace App\Mail;

use App\PSChange;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PSChangeVerify extends Mailable
{
    use Queueable, SerializesModels;

    public $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PSChange $request)
    {
        $this->request= $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('PS Change Verification')
            ->from('noreply@sl.ku.edu.tr', 'KUrel Office')
            ->view('mail.pschangeverify')->with([
                'request' => $this->request
            ]);
    }
}
