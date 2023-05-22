<?php
namespace App\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\Models\User;

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

    /**
     * Get users by role
     *
     * @param string $role
     * @return object
     */
    public function getUsersByRole(string $role): object
    {
        return User::where('role', $role)->get();
    }

    public function updateProfile(array $data,$id): void
    {
        $image_name = time().'.'.$data['image']->extension();
        $data['image']->move(public_path('image/profile'),$image_name);

        $user=User::where('id',$id)->first();
        $user->update([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'image'=>$image_name,

        ]);
    }

    public function passUpdate($request,$user):void {
        $userEmail = User::where('email',$user->email)->first();
        $userUpdate = User::find($userEmail->id);
        $userUpdate->password = bcrypt($request->password);
        $userUpdate->save();
    }


}
