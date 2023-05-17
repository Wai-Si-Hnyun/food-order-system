<?php

namespace App\Services;

use App\Mail\CustomEmailToUser;
use Illuminate\Support\Facades\Mail;
use App\Contracts\Services\MailServiceInterface;

class MailService implements MailServiceInterface
{
    /**
     * Send email to user
     *
     * @param string $email
     * @param string $name
     * @param string $subject
     * @param string $body
     * @return void
     */
    public function send(string $email, string $name, string $subject, string $body)
    {
        Mail::to($email)->queue(new CustomEmailToUser($name, $subject, $body));
    }
}