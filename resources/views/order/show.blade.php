@extends('layouts.app')

@section('content')

<div class="container">
<div class="card">
  <div class="card-body mx-4">
    <div class="container">


    <p class="my-5 mx-5" style="font-size: 30px;">Хүргэлтийн дэлгэрэнгүй</p>
        <div class="table-responsive">

            <table class="table">
               
                    <th class="text-center" colspan=2>Захиалгийн мэдээлэл</th>
                
            <tr>
                <td align="right" width=200>Дугаар:</td>
                <td>  <b>{{$order->id}}</b</td>
            </tr>
            <tr>
                <td align="right">Ажилтан:</td>
                <td> {{$order->user($order->d_user)->name}}</td>
            </tr>
            <tr>
                <td align="right">Оператор:</td>
                <td>{{$order->user($order->c_user)->name}}</td>
            </tr>
            <tr>
                <td align="right">Утасны дугаар:</td>
                <td> {{$order->phone}}</td>
            </tr>
            <tr>
                <td align="right">Ус:</td>
                <td> {{$order->value}}</td>
            </tr>
            <tr>
                <td align="right">Дүүрэг:</td>
                <td> {{$order->duureg()}}</td>
            </tr>
            <tr>
                <td align="right">Хаяг:</td>
                <td>{{$order->address}}</td>
            </tr>
            <tr>
                <td align="right">Төлөв:</td>
                <td>{{$order->status()}}</td>
            </tr>
            
            <tr>
                <th class="text-center" colspan=2>Хүргэлтийн мэдээлэл</th>
            </tr>

            <tr>
                <td align="right">Хүргэсэн огноо:</td>
                <td> {{$order->d_date}}</td>
            </tr>
            <tr>
                <td align="right">Төлбөр:</td>
                <td>{{$order->payment()}}</td>
            </tr>
            <tr>
                <td align="right">Тайлбар:</td>
                <td>{{$order->comfirm_info}}</td>
            </tr>

            </table>


        </div>
            <a class="btn btn-info" href="{{url('show_list')}}">Жагсаалт-руу буцах</a>
     
     
    </div>
  </div>
</div>
</div>

@endsection
