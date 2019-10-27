<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Url;
use App\Redirect;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $urls = Url::where('user_id', auth()->user()->id)->get();
        return view('home')->with('urls', $urls);
    }

}
