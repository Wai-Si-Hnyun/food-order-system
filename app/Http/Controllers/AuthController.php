<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\Request;
use App\Contracts\Services\AuthServiceInterface;
use App\Mail\mailNotify;
use Auth;
use Mail;

class AuthController extends Controller
{
    private $authServiceInterface;

    /**
     * Create a new controller instance.
     * @param AuthServiceInterface $userServiceInterface
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
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function authLogin(Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password'=>'required',
        ]);
        if ($validator->fails()){
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            return redirect('/product/list/'.$user->id);
        }
        else {
            return redirect()->route('auth#login')->with('alert', "email or password may be wrong");
        }
    }

      /**
     * forgetPassword page
     *
     * @return View forgetPassword page
     */
    public function forgetPass() {
        return view ('authen.forgetPassword');
    }

    /**
     * Save token
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function forgetCreate(Request $request) {
        $user = $this->authService->emailCheck($request);
        if (count($user) > 0) {
            $passwordReset =$this->authService->passwordReset($request);
            $data = [
                "subject"=>"Please check your token",
                "body"=>$passwordReset->token
            ];
            $mail = Mail::to($request->email)->send(new mailNotify($data));
            return redirect()->route('auth#resetPass');

        }
        else {
            return redirect()->route('auth#forgetPass')->with('alert', "Your account is not found");
        }
    }

      /**
     * resetPassword page
     *
     * @return View resetPassword page
     */
    public function resetPass() {
        return view ('authen.resetPassword');
    }

    /**
     * Pass Change
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function passChange(Request $request) {
        $validator = Validator::make($request->all(),[
            'token'=>'required',
            'password'=>'required',
            'confirm_password'=>'required|same:password'
        ]);
        if ($validator->fails()){
            return redirect('/resetPasswordPage')
                ->withInput()
                ->withErrors($validator);
        }
        $resetData = $this->authService->findToken($request);
        if (isset($request->token) && $resetData) {
            $update = $this->authService->passUpdate($request,$resetData);
            return redirect('/');
        }
    }

}
