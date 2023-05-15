<?php

namespace App\Http\Controllers;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Http\Request;
use App\Models\User;

class UserdataController extends Controller
{
    private $userService;

    /**
     * Create a new controller instance.
     * @param UserServiceInterface $userServiceInterface
     * @return void
     */

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function userList()
    {
        $user = $this->userService->getUser();
        return view('admin.user.list', [
            'user' => $user
        ]);
    }

    public function roleUpdate (Request $request,$id)
    {
        $roleUpdate = $this->userService->updateRole($request->only([
            'role',
        ]),$id);
          return response()->json(['msg'=>'success'],200);
    }

    public function userInfo($id) {
        $user= $this->userService->getUserById($id);
        return response()->json($user,200);
    }

    public function userDelete($id) {
        $userDelete = User::findOrFail($id);
        $userDelete->delete();
        return response()->json(['userDelete' => $userDelete,'msg'=>'success'],200);
    }

    public function userProfile($id) {
        return view('profile.profile');
    }



}
