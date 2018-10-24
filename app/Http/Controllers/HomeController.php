<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        if (Auth::user()->role_id == 2) {
            return redirect('/');
        } else {
            return redirect('/');
//            return Redirect::to('https://jelti.superfuds.com/home');
        }
    }

}
