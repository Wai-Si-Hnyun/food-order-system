<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class customerController extends Controller
{
    public function care() {
        return view("user.main.help");
    }
}
