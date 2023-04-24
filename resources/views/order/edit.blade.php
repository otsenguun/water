@extends('layouts.app')

@section('content')

<div class="container">
<div class="card">
  <div class="card-body mx-4">
    <div class="container">


        <div class="table-responsive">
        <form action="{{route('order.update',$order->id)}}" method="post">
        @csrf
        {{ method_field('PUT') }}
            <table class="table">
               
                    <th class="text-center" colspan=2>Захиалга засах</th>
                
            <tr>
                <td align="right" width=200>Дугаар:</td>
                <td>  <b>{{$order->id}}</b</td>
            </tr>
            <tr>
                <td align="right">Ажилтан:</td>
                <td>
                    <select name="d_user" id="" class="form-control">
                        @foreach($users as $user)
                            <option value="{{$user->id}}" @if($user->id == $order->d_user) selected @endif>{{$user->name}}</option>
                        @endforeach    
                    </select>
                   </td>
            </tr>
            <tr>
                <td align="right">Оператор:</td>
                <td>{{$order->user($order->c_user)->name}}</td>
            </tr>
            <tr>
                <td align="right">Утасны дугаар:</td>
                <td>
                    <input class="form-control" type="number" name="phone" value="{{$order->phone}}">
                    </td>
            </tr>
            <tr>
                <td align="right">Ус:</td>
                <td><input class="form-control" type="number" name="value" value="{{$order->value}}"></td>
            </tr>
            <tr>
                <td align="right">Дүүрэг:</td>
                <td>
                    <select class="form-control" name="duureg" id="">
                        @foreach($duuregs as $d_key => $duureg)
                            <option value="{{$d_key}}" @if($d_key == $order->duureg) selected @endif>{{$duureg}}</option>
                        @endforeach  
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">Хаяг:</td>
                <td>
                <textarea class="form-control" name="address" id="" cols="30" rows="3">{{$order->address}}</textarea>    
               </td>
            </tr>
            <tr>
                <td align="right">Тайлбар:</td>
                <td>
                <textarea class="form-control"   name="address" id="" cols="30" rows="3">{{$order->info}}</textarea> 
                </td>
            </tr>
            <tr>
                <td align="right">Төлөв:</td>
                <td>{{$order->status()}}</td>
            </tr>
            <tr>
                <td align="right">Хүргэх огноо:</td>
                <td> <input name="d_date" type="date" class="form-control" value="{{$order->d_date}}"></td>
            </tr>
            
            <tr>
                <th class="text-center" colspan=2>Хүргэлтийн мэдээлэл</th>
            </tr>

            <tr>
                <td align="right">Хүргэсэн огноо:</td>
                <td> {{$order->comfirm_date}}</td>
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
            <center>
            <input type="submit" value="Хадгалах" class="btn btn-sm btn-success">
            </center>
           
    </form>
        </div>
            <a class="btn btn-info" href="{{url('show_list')}}">Жагсаалт-руу буцах</a>
     
     
    </div>
  </div>
</div>
</div>

@endsection
