<?php

namespace App\Contracts\Dao;

interface AuthDaoInterface
{
    public function createUser(array $data): void;
}
