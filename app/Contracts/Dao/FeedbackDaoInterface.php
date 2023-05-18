<?php

namespace App\Contracts\Dao;

interface FeedbackDaoInterface
{
    public function createFeedback(array $data):void;
    public function getMessage():object;
}
