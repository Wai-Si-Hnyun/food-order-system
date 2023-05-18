<?php
namespace App\Contracts\Services;

interface FeedbackServiceInterface
{
    public function createFeedback(array $data):void;
    public function getMessage():object;
}
