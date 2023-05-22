<?php

namespace App\Http\Controllers;

use App\Contracts\Services\AuthServiceInterface;
use App\Http\Requests\UserCreateRequest;
use App\Mail\mailNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mail;

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
     * @return \Illuminate\Contracts\View\View login page
     */
    public function login()
    {
        return view('authen.login');
    }

    /**
     * register page
     *
     * @return \Illuminate\Contracts\View\View  register page
     */
    public function registerPage()
    {
        return view('authen.register');
    }

    /**
     * Save user
     *
     * @param \App\Http\Requests\UserCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function authRegisterStore(UserCreateRequest $request)
    {
        $this->authService->createUser($request->only([
            'name', 'email', 'password', 'remember_token',
        ]));
        return redirect()->route('auth.login');
    }

    /**
     * Check user
     *
     * @param \App\Http\Requests\UserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Failed to verify that you are not a robot. Please try again.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }
        $auth = $this->authService->authCheck($request);
        if ($auth) {
            $user = Auth::user();

            //Restore the cart data after logging in
            $cartData = session('cart', []);
            session(['cart' => $cartData]);

            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'user') {
                $redirect = '/';
            }

            return redirect()->intended($redirect);
        } else {
            return redirect()->route('auth.login')->with('alert', "email or password may be wrong");
        }
    }

    /**
     * forgetPassword page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View forgetPassword page
     */
    public function forgetPass()
    {
        return view('authen.forgetPassword');
    }

    /**
     * Save token
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forgetCreate(Request $request)
    {
        $user = $this->authService->emailCheck($request);
        if (count($user) > 0) {
            $passwordReset = $this->authService->passwordReset($request);
            $data = [
                "subject" => "Please check your token",
                "body" => $passwordReset->token,
            ];
            $mail = Mail::to($request->email)->send(new mailNotify($data));
            return redirect()->route('auth.resetPass');

        } else {
            return redirect()->route('auth.forgetPass')->with('alert', "Your account is not found");
        }
    }

    /**
     * resetPassword page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View resetPassword page
     */
    public function resetPass()
    {
        return view('authen.resetPassword');
    }

    /**
     * Pass Change
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passChange(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return redirect('/resetPasswordPage')
                ->withInput()
                ->withErrors($validator);
        }
        $resetData = $this->authService->findToken($request);
        if (isset($request->token) && $resetData) {
            $update = $this->authService->passUpdate($request, $resetData);
            return redirect('/login');
        }
    }
}
