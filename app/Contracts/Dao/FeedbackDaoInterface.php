<?php

namespace App\Contracts\Dao;

interface FeedbackDaoInterface
{
    public function createFeedback(array $data):void;
    public function getMessage():object;
    public function searchfeedback():object;
    public function getFeedbackById(int $id): object;
}
