<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomEmailToUser extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $subject;
    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $subject, $body)
    {
        $this->name = $name;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->markdown('mail.custom', [
                'name' => $this->name,
                'bodyText' => $this->body,
            ]);
    }
}
