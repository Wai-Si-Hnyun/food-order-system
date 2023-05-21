<?php

namespace App\Http\Controllers;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Auth;

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

    /**
     * function user list
     */
    public function userList()
    {
        $user = $this->userService->getUser();
        return view('admin.pages.user.list', [
            'user' => $user
        ]);
    }

    /**
     * function user role update
     */
    public function roleUpdate (Request $request,$id)
    {
        $roleUpdate = $this->userService->updateRole($request->only([
            'role',
        ]),$id);
          return response()->json(['msg'=>'success'],200);
    }

    /**
     * function user single data
     */
    public function userInfo($id) {
        $user= $this->userService->getUserById($id);
        return response()->json($user,200);
    }

    /**
     * function user delete
     */

    public function userDelete($id) {
        $userDelete = User::findOrFail($id);
        $userDelete->delete();
        return response()->json(['userDelete' => $userDelete,'msg'=>'success'],200);
    }

    /**
     * function user profile show
     */
    public function userProfile($id) {
        $user= $this->userService->getUserById($id);
        return view('profile.profile', [
            'user' => $user
        ]);
    }

        /**
     * function user profile update
     */
    public function profileUpdate (Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'image' => 'mimes:jpeg,png,jpg,gif|max:1024',
        ]);
        if ($validator->fails()){
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }
        else {
            $userProfile =$this->userService->updateProfile($request->only([
                'name','email','image',
            ]),$id);
            return redirect()->back();
        }

    }

        /**
     * function user pass change
     */

    public function passChange($id) {
        $user= $this->userService->getUserById($id);
        return view('profile.change.password', [
            'user' => $user
        ]);
    }

        /**
     * function user pass update
     */

    public function passwordUpdate(Request $request){
        $validator = Validator::make($request->all(),[
            'old_password'=>'required',
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password'
        ]);
        if ($validator->fails()){
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }
        if (Auth::attempt(['id'=>$request->id,'password'=>$request->old_password])) {
            $user = Auth::user();
            $update = $this->userService->passUpdate($request,$user);
            return redirect()->back();
        }else {
            return redirect()->back();
        }
    }

        /**
     * function user acc delete
     */
    public function accountDelete($id) {
        $userDelete = User::findOrFail($id);
        $userDelete->delete();
        return redirect('/');

    }



}
