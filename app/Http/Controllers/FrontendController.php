<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function portal()
    {
        return view('frontend.home');
    }
}
