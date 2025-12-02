<?php

namespace App\Mail;

use App\Models\SupportRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportRequestMail extends Mailable
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
        $mail = $this->subject('New Support Request');

        // 🔹 form এ যদি email দেওয়া থাকে, তাহলে Reply করতে সরাসরি ওখানে যাবে
        if ($this->support->email) {
            $mail->replyTo($this->support->email, $this->support->name ?? null);
        }

        return $mail->view('emails.support.request');
    }
}
