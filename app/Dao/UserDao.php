<?php
namespace App\Dao;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Dao\UserDaoInterface;

class UserDao implements UserDaoInterface
{
    public function getUser():object {
        return User::orderBy('created_at', 'asc')->paginate(10);
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

    public function getUsersByRole(string $role): object
    {
        return User::where('role',$role)->get();
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

    public function updatefile(array $data,$id): void
    {

        $user=User::where('id',$id)->first();
        $user->update([
            'name'=>$data['name'],
            'email'=>$data['email'],

        ]);
    }

    public function passUpdate($request,$user) {
        $userEmail = User::where('email',$user->email)->first();
        $userUpdate = User::find($userEmail->id);
        $userUpdate->password = bcrypt($request->password);
        $userUpdate->save();

        return redirect()->back();
    }

    public function searchUser():object
    {
        $search_name = request()->query('query');
        $users = User::where('users.name','LIKE','%'.$search_name.'%')
        ->latest()
        ->paginate(10);

        $users->appends(['query' => $search_name]);

        return $users;
    }

    public function authCheck($request) : bool
    {
        return Auth::attempt(['id'=>$request->id,'password'=>$request->old_password]);
    }
}
