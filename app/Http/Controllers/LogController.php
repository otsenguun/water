<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $log_types =[
            0 => "Захиалга хүлээн авсан",
            1 => "Захиалгын огноо солисон",
            2 => "Захиалга баталгаажуулсан түгээгч",
            3 => "Захиалга шинээр бүртгэсэн",
            4 => "Захиалга зассан"
        ];

        $sdate = date("Y-m-d");
        if(!is_null($request->d_date)){
            $sdate = $request->d_date;
            // dd($request->date);
        }

        $logs = Log::withWhere($request->only('type'))->where("created_at",">=",$sdate)
        ->orderBy('id', 'asc')->paginate(100);
        return view("pages.log",["logs"=> $logs,"log_types"=>$log_types,"s_date"=>$sdate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Log $log)
    {
        // dd($log);
        return view("pages.show",["log"=> $log]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log)
    {
        //
    }
}
