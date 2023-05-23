<?php

namespace App\Contracts\Dao;

interface UserDaoInterface
{
    public function getUser():object;
    public function updateRole(array $data, $id): void;
    public function getUserById(int $id): object;
    public function updateProfile(array $data,$id): void;
    public function passUpdate($request,$user):void ;
    public function searchUser():object;
    public function updatefile(array $data,$id): void;
    public function authCheck($request) : bool;
}
