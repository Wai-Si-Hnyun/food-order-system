<?php
namespace App\Contracts\Services;

interface AuthServiceInterface
{
    public function createUser(array $data): void;
}
