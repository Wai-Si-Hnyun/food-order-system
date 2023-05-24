<?php
namespace App\Contracts\Services;

interface ReviewServiceInterface
{
    public function createReview(array $data): void;
    public function reviewShow(int $id):object ;
    public function getReviewById(int $id): object;
    public function getReview(): object;
    public function searchReview():object;
    public function updateReview(array $data,int $id): void;
}
