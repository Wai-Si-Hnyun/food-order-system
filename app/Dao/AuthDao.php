<?php
namespace App\Dao;

use App\Contracts\Dao\AuthDaoInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthDao implements AuthDaoInterface
{
    public function createUser(array $data): void
    {
        $token =Str::random(40);
        User::create([
            'name' => $data['name'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password']),
            'remember_token'=>$token,
        ]);
    }
}
