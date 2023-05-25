<?php
namespace App\Dao;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Dao\AuthDaoInterface;

class AuthDao implements AuthDaoInterface
{
    public function createUser(array $data): void
    {
        $token = Str::random(40);
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'remember_token' => $token,
        ]);
    }

    public function emailCheck($request): object
    {
        return User::where('email', $request->email)->get();
    }

    public function passwordReset($request): object
    {
        $token = Str::random(40);
        $datetime = Carbon::now()->format('Y-m-d H-i-s');
        return PasswordReset::updateOrCreate(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => $datetime,
            ]
        );
    }

    public function findToken($request): object
    {
        return PasswordReset::where('token', $request->token)->get();
    }

    public function passUpdate($request, $resetData): void
    {
        $user = User::where('email', $resetData[0]['email'])->first();
        $userUpdate = User::find($user->id);
        $userUpdate->password = bcrypt($request->password);
        $userUpdate->save();
    }

    public function getNameById(int $id): object
    {
        return User::findOrFail($id);
    }

    public function authCheck($request) : bool
    {
        return Auth::attempt(['email' => $request->email, 'password' => $request->password]);
    }
}

