<?php
namespace App\Contracts\Services;

interface AuthServiceInterface
{
    public function createUser(array $data): void;
    public function emailCheck($request):object;
    public function passwordReset($request):object;
    public function findToken($request):object;
    public function passUpdate($request,$resetData):void;
}
