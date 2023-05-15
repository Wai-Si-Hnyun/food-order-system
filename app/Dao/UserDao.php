<?php
namespace App\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Review;

class UserDao implements UserDaoInterface
{
    public function getUser():object {
        return User::orderBy('created_at', 'asc')->get();
    }

    public function updateRole(array $data, $id): void
    {
        $userRole = User::findOrFail($id);
        $userRole->update([
            'role'=>$data['role'],
        ]);
    }

    public function getUserById(int $id): object
    {
        return User::findOrFail($id);
    }

}
