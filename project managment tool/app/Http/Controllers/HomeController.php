<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function contact()
    {
        return view('pages.pages-contact');
    }
    public function profile()
    {
        return view('pages.users-profile');
    }
    public function eror404()
    {
        return view('pages.pages-error-404');
    }
    public function faq()
    {
        return view('pages.pages-faq');
    }
    public function index()
    {
        return view('home');
    }
}
