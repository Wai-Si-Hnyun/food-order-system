<?php

namespace App\Contracts\Dao;

interface ReviewDaoInterface
{
    public function createReview(array $data): void;
    public function reviewShow(int $id):object ;
    public function updateReview(array $data, $id): void;
    public function getReviewById(int $id): object;

    public function getReview(): object;
}
