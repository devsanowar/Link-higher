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
    public $fromName;

    /**
     * Create a new message instance.
     */
    public function __construct(SupportRequest $support, $fromName = null)
    {
        $this->support  = $support;
        $this->fromName = $fromName;   // Website title from DB
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Sender Name (from DB, fallback app.name)
        $websiteTitle = $this->fromName ?: config('app.name');

        return $this
            ->from(config('mail.from.address'), $websiteTitle)
            ->subject('Thanks for contacting ' . $websiteTitle)
            ->markdown('emails.support.thankyou');
    }
}
