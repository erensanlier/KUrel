<?php

namespace App\Mail;

use App\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
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
        return $this->subject('Request Deleted')
            ->from('noreply@sl.ku.edu.tr', 'KUrel Office')
            ->view('mail.requestdeleted')->with([
                'request' => $this->request

            ]);
    }
}
