<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Log;
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


    public function showOrderProcess($phone){
        
        $finds = Order::select("d_user","d_date",)
        ->where('phone', 'like', '%' . $phone . '%')->where('status',0)->orderBy("id","desc")->get(1);

        if(count($finds) > 0){

            $orders = Order::select("*")
            ->where('d_user',$finds[0]->d_user)
            ->where('d_date',$finds[0]->d_date)
            ->orderBy("index","asc")->get(50);
            
            $huleelt = 0;

            foreach($orders as $order){
                if($order->phone == $phone){
                    break;
                }elseif($order->status == 0){
                    $huleelt ++;
                }
            }

            if($huleelt == 0){
                $title = "<span class='btn btn-primary'>Захиалга хүргэгдэж байна <b>0</b> хүргэлтйн дараа<span>";
            }else{
                $title = "<span class='btn btn-dark'>Захиалга <b>$huleelt</b> хүргэлтйн дараа<span>";
            }

            return View::make('order.progress', ['orders' => $orders,'title' => $title,'phone'=>$phone]);

        }else{

        }

    }

    public function setOrder(Request $request){

        $order = Order::find($request->order_id);
        $order->d_user = Auth::user()->id;
        $order->save();

        $log = new Log;
        $log->c_user = Auth::user()->id;
        $log->type = 0;
        $log->data = json_encode($request);
        $log->save();
        return redirect()->back();

    }

    public function changeDate(Request $request){

        $old = Order::find($request->order_id);
        $order = Order::find($request->order_id);
       

        $order->d_date = $request->ch_date;
        $order->save();
        
        $new = $order;

        $log = new Log;
        $log->c_user = Auth::user()->id;
        $log->type = 1;
        $data = [
            "old" => $old,
            "new" => $new
        ];
        $log->data = json_encode($data);
        $log->save();
        return redirect()->back();
    }
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

        $log = new Log;
        $log->c_user = Auth::user()->id;
        $log->type = 2;
        $log->data = json_encode($order);
        $log->save();

        return redirect()->back();        
    }

     public function searchPhone($phone){
        $duureg = $this->duureg;

        $order = Order::select("address","duureg","phone","payment")
        ->where('phone', 'like', '%' . $phone . '%')->orderBy("id","desc")->get(5);
        $response = [];
        foreach($order as $or){
            $obj = [
                "address" => $or->address,
                "phone" => $or->phone,
                "duureg" => $duureg[$or->duureg],
                "duureg_key" => $or->duureg,
                "payment" => $or->payment(),
            ];
            $response[$or->address] = $obj;
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
            ->withWhere($request->only('duureg','phone',"status"))->where("d_date",$sdate)
            ->orderBy('index', 'asc')->paginate(100);
            return view("order.list",['orders' => $orders,"duureg"=>$duureg,"request"=>$request]);
        }else{
            $users = User::select("id","name")->where("type",1)->get();
            $orders = Order::withWhere($request->only('duureg','phone','d_user',"status"))->where("d_date",$sdate)
            ->orderBy('index', 'asc')->paginate(100);
            return view("order.listop",['orders' => $orders,"duureg"=>$duureg,"request"=>$request,"users" => $users]);

        }
      
    }
    public function indexNot(Request $request)
    {
        $sdate = date("Y-m-d");
        if(!is_null($request->d_date)){
            $sdate = $request->d_date;
            // dd($request->date);
        }
        $duureg = $this->duureg;
        if(Auth::user()->type == 1){
            $orders = Order::where("d_user",0)
            ->withWhere($request->only('duureg','phone',"status"))->where("d_date",$sdate)
            ->orderBy('index', 'asc')->paginate(100);
            return view("order.notset",['orders' => $orders,"duureg"=>$duureg,"request"=>$request]);
        }else{
            $users = User::select("id","name")->where("type",1)->get();
            $orders = Order::where("d_user",0)->withWhere($request->only('duureg','phone',"status"))->where("d_date",$sdate)
            ->orderBy('index', 'asc')->paginate(100);
            return view("order.notset",['orders' => $orders,"duureg"=>$duureg,"request"=>$request,"users" => $users]);

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
    public function createD($s_duureg)
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
        // $del = User::find($id);

        return View::make('order.renderD', ['s_duureg' => $s_duureg,"duuregs" => $duureg]);
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
        $order->d_user = intval($request->d_user);
        $order->d_date = $request->d_date;
        $order->payment = $request->payment;
        $order->save();


        $log = new Log;
        $log->c_user = Auth::user()->id;
        $log->type = 3;
        $log->data = json_encode($order);
        $log->save();

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
        $duuregs = [
            1 => "Баянзүрх",
            2 => "Баянгол",
            3 => "Сонгино хайрхан",
            4 => "Чингэлтэй",
            5 => "Сүхбаатар",
            6 => "Налайх",
            7 => "Хан-уул"
        ];
        $users = User::where("type",1)->get();
        $order = Order::find($id);
        return view("order.edit",["duuregs" =>$duuregs,"users" => $users,"order"=>$order]);
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
        // dd($request);
        $old = Order::find($id);

        $order = Order::find($id);
      

        $order->d_user = intval($request->d_user);
        $order->phone = $request->phone;
        $order->duureg = $request->duureg;
        $order->address = $request->address;
        $order->value = $request->value;
        $order->d_date = $request->d_date;
        $new = $order;
        $order->save();

        $log = new Log;
        $log->c_user = Auth::user()->id;
        $log->type = 4;
        $data = [
            "old" => $old,
            "new" => $new
        ];
        $log->data = json_encode($data);
        $log->save();


        return redirect()->route("order.show",$order->id);
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
