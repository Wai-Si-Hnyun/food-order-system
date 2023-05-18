<?php
namespace App\Services;

use App\Contracts\Dao\FeedbackDaoInterface;
use App\Contracts\Services\FeedbackServiceInterface;
//use App\Models\User;

/**
 * FeedbackService class
 */
class FeedbackService implements FeedbackServiceInterface
{
    private $feedbackDao;
    public function __construct(FeedbackDaoInterface $feedbackDao)
    {
        $this->feedbackDao = $feedbackDao;
    }
    public function createFeedback(array $data): void
    {
        $this->feedbackDao->createFeedback($data);
    }

    public function getMessage(): object
    {
        return $this->feedbackDao->getMessage();
    }
}
