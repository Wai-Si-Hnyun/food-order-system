<?php

namespace  App\Contracts\Services;

interface MailServiceInterface
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
    public function send(string $email, string $name, string $subject, string $body);
}