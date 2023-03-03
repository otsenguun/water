<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Order;
class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($duureg)
    {
        $orders = Order::where("duureg",$duureg)->get();
        $duureg = [
            0 => "Хан-уул",
            1 => "Баянзүрх",
            2 => "Баянгол",
            3 => "СХД",
            4 => "Чингэлтэй",
            5 => "Сүхбаатар",
            6 => "Налайх"
        ];
        return view("order.list",['orders' => $orders,"duureg"=>$duureg]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$date)
    {
        $duureg = [
            0 => "Хан-уул",
            1 => "Баянзүрх",
            2 => "Баянгол",
            3 => "Сонгино хайрхан",
            4 => "Чингэлтэй",
            5 => "Сүхбаатар",
            6 => "Налайх"
        ];
        $del = User::find($id);

        return View::make('order.render', ['del' => $del,"date" => $date,"duuregs" => $duureg]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        // dd($request);
        $order = new Order;
        $order->phone = $request->phone;
        $order->duureg = $request->duureg;
        $order->address = $request->address;
        $order->value = $request->value;
        $order->info = $request->info;
        $order->c_user = $request->c_user;
        $order->d_user = $request->d_user;
        $order->d_date = $request->d_date;
        $order->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
