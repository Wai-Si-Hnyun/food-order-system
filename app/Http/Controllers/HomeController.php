<?php

namespace App\Http\Controllers;
use Auth;
use App\Contracts\Services\UserServiceInterface;

class HomeController extends Controller
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
     * Go to home page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function home()
    {
        return view('user.pages.home');
    }

    /**
     * Go to admin dashboard page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function adminDashboard()
    {
        $user = Auth::user();
        return view('admin.pages.dashboard',compact('user'));
    }
}
