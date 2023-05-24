<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Services\UserServiceInterface;

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
        $userDelete = $this->userService->getUserById($id);
        $userDelete->delete();
        return response()->json(['userDelete' => $userDelete,'msg'=>'success'],200);
    }

    /**
     * function user profile show
     */
    public function userProfile($id) {
        $user= $this->userService->getUserById($id);
        if($user->role == 'user') {
            return view('profile.profile', [
                'user' => $user
            ]);
        }
        else {
            return view('profile.admin', [
                'user' => $user
            ]);
        }
    }

        /**
     * function user profile update
     */
    public function profileUpdate (Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'image' => 'mimes:jpeg,png,jpg,gif|max:1024',
            'name' => 'required',
            'email' => 'required|email|' . Rule::unique('users', 'email')->ignore($id),
        ]);
        if ($validator->fails()){
            return redirect()->back()
                ->with('update','Please Update again!.')
                ->withErrors($validator);
        }
        else {
            if ($request->image == null) {
                $userProfile =$this->userService->updatefile($request->only([
                    'name','email'
                ]),$id);
                return redirect()->back()->with('alert','Profile update successfully');
            }
            else {
                $userProfile =$this->userService->updateProfile($request->only([
                    'name','email','image'
                ]),$id);
                return redirect()->back()->with('alert','Profile update successfully');
            }
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
        $auth =$this->userService->authCheck($request);
        if (Auth::attempt(['id'=>$request->id,'password'=>$request->old_password])) {
            $user = Auth::user();
            $update = $this->userService->passUpdate($request,$user);
            return redirect()->back()->with('alert',"Passord change successful");
        }else {
            return redirect()->back()->with('message',"error");
        }
    }


    /**
     * function search user
     */
    public function search() {


        $user=$this->userService->searchUser();
        return view('admin.pages.user.list', [
            'user' => $user
        ]);

    }



}
