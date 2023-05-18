<?php
namespace App\Contracts\Services;

interface UserServiceInterface
{
    public function getUser():object;
    public function updateRole(array $data,int $id): void;
    public function getUserById(int $id): object;
    public function updateProfile(array $data,int $id): void;
    public function passUpdate($request,$user):void ;
}
