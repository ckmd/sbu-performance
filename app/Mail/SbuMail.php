<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SbuMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $targetEmail = $this->details['targetEmail'];
        $subject = $this->details['subject'];
        $attachment = $this->details['attachment'];
        // return $this->view('view.name');
        return $this->to($targetEmail)
            ->subject($subject)
            ->attach($attachment)
            ->view('email.index');
    }
}
