<?php

namespace App\Contracts\Dao;

interface AuthDaoInterface
{
    public function createUser(array $data): void;
    public function emailCheck($request):object;
    public function passwordReset($request):object;
    public function findToken($request):object;
    public function passUpdate($request,$resetData):void;
    public function getNameById(int $id): object;
}
