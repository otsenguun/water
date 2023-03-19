<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        if(Auth::user()->type == 0){
            $duureg = [
                1 => "Баянзүрх",
                2 => "Баянгол",
                3 => "СХД",
                4 => "Чингэлтэй",
                5 => "Сүхбаатар",
                6 => "Налайх",
                7 => "Хан-уул"
            ];
            $date_arr = [];

            $date = strtotime(date("Y-m-d"));
    
           
            for($i = 0; $i < 7; $i++){
                
                $date_arr[] = date("Y-m-d",$date);
                $date += 86400;
        
            }
    
            $plans = Plan::paginate(100);
            $users = User::where("type",1)->get();
            return view('home',compact("users","date_arr","duureg"));
        }else{
            return redirect()->route('order.index');
        }
      
        // dd($users);
     
    }
}
