<?php

namespace App\Mail;

use App\PSChange;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PSChangeNotifyMail extends Mailable
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
        return $this->subject('PS Change Request')
            ->from('noreply@sl.ku.edu.tr', 'KUrel Office')
            ->view('mail.pschangenotifymail')->with([
                'request' => $this->request
            ]);
    }
}
