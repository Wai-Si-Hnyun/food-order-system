<?php
namespace App\Services;

use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Models\User;

/**
 * User Service class
 */
class UserService implements UserServiceInterface
{
    private $userDao;
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }

    public function getUser(): object
    {
        return $this->userDao->getUser();
    }

    public function updateRole(array $data, int $id): void
    {
        $this->userDao->updateRole($data, $id);
    }

    public function getUserById(int $id): object
    {
        return $this->userDao->getUserById($id);
    }

    public function updateProfile(array $data, int $id): void
    {
        $this->userDao->updateProfile($data, $id);
    }

    public function updatefile(array $data, int $id): void
    {
        $this->userDao->updatefile($data, $id);
    }

    public function passUpdate($request,$user): void
    {
        $this->userDao->passUpdate($request,$user);
    }

    public function searchUser(): object
    {
        return $this->userDao->searchUser();
    }

    public function authCheck($request): bool
    {
        return $this->userDao->authCheck($request);
    }
}
