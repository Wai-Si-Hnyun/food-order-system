<?php
namespace App\Services;

use App\Contracts\Dao\AuthDaoInterface;
use App\Contracts\Services\AuthServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

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
}
