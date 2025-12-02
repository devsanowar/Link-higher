<?php

namespace App\Mail;

use App\Models\SupportRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportRequestThankYouMail extends Mailable
{
    use Queueable, SerializesModels;

    public $support;

    /**
     * Create a new message instance.
     */
    public function __construct(SupportRequest $support)
    {
        $this->support = $support;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Thanks for contacting Sanwoar Web Agency')
                    ->markdown('emails.support.thankyou');
    }
}
