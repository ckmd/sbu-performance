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

        $mail = $this->subject($subject);
        if ($this->details['attachment']) {
            foreach($this->details['attachment'] as $file)
                $mail->attach($file->getRealPath(), [
                    'as' => $file->getClientOriginalName(), 
                    'mime' => $file->getMimeType()
                ]);
            }
        // return $this->view('view.name');
        return $this->to($targetEmail)
            ->view('email.index');
    }
}
