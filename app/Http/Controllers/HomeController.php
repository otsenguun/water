<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
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
        $plans = Plan::paginate(100);
        return view('home');
    }
}
