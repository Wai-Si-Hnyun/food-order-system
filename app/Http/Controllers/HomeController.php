<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
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
        return view('admin.pages.dashboard');
    }
}
