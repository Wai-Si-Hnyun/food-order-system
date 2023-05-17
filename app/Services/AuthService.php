<?php
namespace App\Services;

use App\Contracts\Dao\AuthDaoInterface;
use App\Contracts\Services\AuthServiceInterface;
use App\Models\User;

/**
 * User Service class
 */
class AuthService implements AuthServiceInterface
{
    private $authDao;
    public function __construct(AuthDaoInterface $authDao)
    {
        $this->authDao = $authDao;
    }

    public function createUser(array $data): void
    {
        $this->authDao->createUser($data);
    }

    public function emailCheck($request): object
    {
       return $this->authDao->emailCheck($request);
    }

    public function passwordReset($request): object
    {
       return $this->authDao->passwordReset($request);
    }

    public function findToken($request): object
    {
       return $this->authDao->findToken($request);
    }

    public function passUpdate($request,$resetData): void
    {
        $this->authDao->passUpdate($request,$resetData);
    }

    public function getNameById(int $id): object
    {
        return $this->authDao->getNameById($id);
    }
}
