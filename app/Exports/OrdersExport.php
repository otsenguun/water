<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection
{

    protected $date1;
    protected $date2;

    function __construct($date1,$date2) {
            $this->date1 = $date1;
            $this->date2 = $date2;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        // return Order::select("id", "c_user", "d_user")->get();
        // dd($this->date1);

        $orders = Order::select("id", "c_user", "d_user","phone","duureg","address","value","d_date","status","info","confirm_date","payment","confirm_info")
        ->where("d_date",">=",$this->date1)
        ->where("d_date","<=",$this->date2)
        ->get();
        $header = ["Дугаар", "Оператор", "Ажилтан","Утасны дугаар","Дүүрэг","Хаяг","Тоо","Хүргэх огноо","Төлөв","Утга","Хүрэггдсэн огноо","Төлбөр","Тайлбар"];
        $arr = [$header];
        foreach($orders as $o){
            $oss = new Order;

            $o->c_user = $o->user($o->c_user)->name;
            $o->d_user = $o->user($o->d_user)->name;
            $o->status = $o->status();
            $o->payment = $o->payment();
            $o->duureg = $o->duureg();
            $arr[] = $o;
        }
        // $arr = [1,2,3];
        // dd($orders);

        return collect($arr);
    }

    public function headings()
    {
        return ["Дугаар", "Үүсгэсэн", "Ажилтан","Утасны дугаар","Дүүрэг","Хаяг","Тоо","Хүргэх огноо","Төлөв","Утга","Хүрэггдсэн огноо","Төлбөр","Тайлбар"];
    }

}
