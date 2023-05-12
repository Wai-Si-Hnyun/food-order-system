<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\Request;
use App\Contracts\Services\AuthServiceInterface;
use Auth;

class AuthController extends Controller
{
    private $authService;

    /**
     * Create a new controller instance.
     * @param \App\Contracts\Services\AuthServiceInterface $userServiceInterface
     * @return void
     */

    public function __construct(AuthServiceInterface $authServiceInterface)
    {
        $this->authService = $authServiceInterface;
    }

      /**
     * login page
     *
     * @return View login page
     */
    public function login() {
        return view('authen.login');
    }


      /**
     * register page
     *
     * @return View register page
     */
    public function registerPage() {
        return view ('authen.register');
    }


    /**
     * Save user
     *
     * @param \App\Http\Requests\UserCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function authRegisterStore(UserCreateRequest $request) {
        $this->authService->createUser($request->only([
            'name','email','password','remember_token',
        ]));
        return redirect()->route('auth#login');
    }

     /**
     * Check user
     *
     * @param \App\Http\Requests\UserCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function authLogin(Request $request) {
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            return redirect()->route('category#list');
        }
        else {
            return redirect()->route('auth#login')->with('alert', "<script>alert('email or password may be wrong')</script>");
        }
    }


}
