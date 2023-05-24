<?php
namespace App\Services;

use App\Contracts\Dao\ReviewDaoInterface;
use App\Contracts\Services\ReviewServiceInterface;

/**
 * User Service class
 */
class ReviewService implements ReviewServiceInterface
{
    private $reviewDao;
    public function __construct(ReviewDaoInterface $reviewDao)
    {
        $this->reviewDao = $reviewDao;
    }

    public function createReview(array $data): void
    {
        $this->reviewDao->createReview($data);
    }

    public function updateReview(array $data,int $id): void
    {
        $this->reviewDao->updateReview($data,$id);
    }


    public function reviewShow(int $id): object
    {
        return $this->reviewDao->reviewShow($id);
    }

    public function getReview(): object
    {
        return $this->reviewDao->getReview();
    }

    public function searchReview(): object
    {
        return $this->reviewDao->searchReview();
    }

    public function getReviewById(int $id): object
    {
        return $this->reviewDao->getReviewById($id);
    }

    public function deleteReviewById(int $id): object
    {
        return $this->reviewDao->deleteReviewById($id);
    }
}
