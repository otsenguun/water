<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;
class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $duureg = [
        1 => "Баянзүрх",
        2 => "Баянгол",
        3 => "СХД",
        4 => "Чингэлтэй",
        5 => "Сүхбаатар",
        6 => "Налайх",
        7 => "Хан-уул"
    ];


    public function export(Request $request) 
    {
        $date1 = $request->date1;
        $date2 = $request->date2;
        return Excel::download(new OrdersExport($date1,$date2), 'Ospring Хүргэлт '.$date1."-аас ".$date2.'.xlsx');
    }

     public function confirmOrder(Request $request){

        $order = Order::findOrFail($request->order_id);
        $order->payment = $request->payment;
        $order->status = $request->status;
        $order->confirm_info = $request->confirm_info;
        $order->confirm_date = date("Y-m-d h:i:s");
        $order->save();

        return redirect()->back();        
    }

     public function searchPhone($phone){
        $duureg = $this->duureg;

        $order = Order::select("address","duureg","phone","payment")
        ->where('phone', 'like', '%' . $phone . '%')->orderBy("id","asc")->get(5);
        $response = [];
        foreach($order as $or){
            $obj = [
                "address" => $or->address,
                "duureg" => $duureg[$or->duureg],
                "duureg_key" => $or->duureg,
                "payment" => $or->payment(),
            ];
            $response[$or->phone] = $obj;
        }
        return json_encode($response);

    }

    public function setIndex(Request $request){

        if(is_array($request->index)){
            foreach($request->index as $key => $id){
                $order = Order::find($id);
                $order->index = $key;
                $order->save();
            }
        }
        return json_encode(1);

    }

    public function index(Request $request)
    {
        $sdate = date("Y-m-d");
        if(!is_null($request->d_date)){
            $sdate = $request->d_date;
            // dd($request->date);
        }
        $duureg = $this->duureg;
        if(Auth::user()->type == 1){
            $orders = Order::where("d_user",Auth::user()->id)
            ->withWhere($request->only('duureg','phone'))->where("d_date",$sdate)
            ->orderBy('index', 'asc')->paginate(100);
            return view("order.list",['orders' => $orders,"duureg"=>$duureg,"request"=>$request]);
        }else{
            $users = User::select("id","name")->where("type",1)->get();
            $orders = Order::withWhere($request->only('duureg','phone','d_user'))->where("d_date",$sdate)
            ->orderBy('index', 'asc')->paginate(100);
            return view("order.listop",['orders' => $orders,"duureg"=>$duureg,"request"=>$request,"users" => $users]);

        }
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$date)
    {
        $duureg = [
            1 => "Баянзүрх",
            2 => "Баянгол",
            3 => "Сонгино хайрхан",
            4 => "Чингэлтэй",
            5 => "Сүхбаатар",
            6 => "Налайх",
            7 => "Хан-уул"
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

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $duureg = [
            1 => "Баянзүрх",
            2 => "Баянгол",
            3 => "Сонгино хайрхан",
            4 => "Чингэлтэй",
            5 => "Сүхбаатар",
            6 => "Налайх",
            7 => "Хан-уул"
        ];

        return view("order.show",['order'=>$order]);
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
