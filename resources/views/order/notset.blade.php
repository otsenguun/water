@extends('layouts.app')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="container">

<style>
      .d_button{
        width: 100px;
        margin:5px;
    }
</style>

<form action="" method="get" id="s_form">

<div class="row">
<a href="{{route('order.index')}}" class="btn btn-primary">Миний жагсаалт</a>
<hr>
<div class="row col-md-12">

  
  <button class="btn btn-primary d_button" type="button" data_id ="">
        Бүгд
  </button>

    @foreach($duureg as $key => $dd)
 
  
     <button class="btn btn-primary d_button" type="button" data_id ="{{$key}}" @if($request->duureg == $key) disabled @endif>
            {{$dd}}
     </button>

    @endforeach
</div>
<input type="hidden" name="duureg" value="{{$request->duureg}}">

<div class="col-md-3">
    <label for="">Төлөв</label>
    <select name="status" id="" class="form-control">
        <option value="">-бүгд-</option>
        <option value="0" @if($request->status == "0") selected @endif>Хүлээгдэж байна</option>
        <option value="1" @if($request->status == 1) selected @endif>Хүргэгдсэн</option>
        <option value="2" @if($request->status == 2) selected @endif>Цуцлагдсан</option>
    </select>
</div>

<div class="col-md-3">
    <label for="">Утасны дугаар</label>
    <input type="text" name="phone" class="form-control" value={{$request->phone}}>
</div>
<div class="col-md-3">
   
   
    <label for="">Огноо</label>
    <div class="input-group mb-3">
  
    <input type="date" name="d_date" class="form-control" value="@if(isset($request->d_date)){{$request->d_date}}@else{{date('Y-m-d')}}@endif">
    <div class="input-group-append">
        <span class="input-group-text" id="basic-addon2">  <input type="submit" value="Хайх" class="form-control"></span>
    </div>
</div>
</div>


</div>

</form>
<hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Хувиарлаагүй Хүргэлтүүд</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">

                  
                        <table class="table">
                            <thead>
                                <th>№</th>
                                    <th>Утасны дугаар</th>
                                    <th>Дүүрэг</th>
                                    <th>Хаяг</th>
                                    <th>Усны тоо</th>
                                    <th>Тайлбар</th>
                                    <th>Хүргэх огноо</th>
                                    <th>Төлөв</th>
                                    <th>Төлбөр</th>
                                    <th>#</th>

                            </thead>
                                <tbody>
                                    @foreach($orders as $key => $order)
                                    <tr class="index" data_id="{{$order->id}}">
                                        <td>{{$key+1}}</td>
                                        <td>{{$order->phone}}</td>
                                        <td>{{$duureg[$order->duureg]}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->value}}</td>
                                        <td>{{$order->info}}</td>
                                        <td>{{$order->d_date}}</td>
                                        <td>

                                            @if($order->status == 0)
                                            <span class="btn btn-warning">Хүлээгдэж байна</span>
                                            @elseif($order->status == 1)
                                            <span class="btn btn-success">Хүргэгдсэн {{$order->confirm_date}}</span>
                                            @else
                                            <span class="btn btn-danger">Цуцлагдсан</span>
                                            @endif
                                          
                                            <!-- {{$order->status}} -->
                                        </td>
                                        <td>
                                            @if($order->payment == 0)
                                            <span class="btn btn-danger">Төлөгдөөгүй</span>
                                            @elseif($order->payment == 1)
                                            <span class="btn btn-success">Бэлэн</span>
                                            @elseif($order->payment == 2)
                                            <span class="btn btn-primary">Данс</span>
                                            @elseif($order->payment == 3)
                                            <span class="btn btn-warning">Дараа төлөх</span>
                                            @elseif($order->payment == 4)
                                            <span class="btn btn-success">Урьдчилсан</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if(Auth::user()->type == 1)
                                            <button 
                                            order_id = "{{$order->id}}" 
                                            phone="{{$order->phone}}" 
                                            payment="{{$order->payment}}" 
                                            status="{{$order->status}}" 
                                            address="{{$order->address}}" 
                                            duureg="{{$duureg[$order->duureg]}}" 
                                            class="btn btn-sm btn-primary confirm">
                                                Сонгох
                                            </button>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Захиалга хүлээж авах</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="order_body">
            <form action="{{url('setOrder')}}" method="post">
            @csrf
            <input type="hidden" name="order_id">


                <h5>Хүргэлтийн дугаар: <b id="order_id"></b></h5>
                <h5>Утасны дугаар: <b id="phone"></b></h5>
                <h5>Дүүрэг : <b id="duureg"></b></h5>
                <h5>Хаяг: <b id="address"></b></h5>

                <div class="text-center">
                    <input type="submit" class="btn btn-sm" value="Хадгалах">
                </div>

            </form>
      </div>
     
    </div>
  </div>
</div>

<script>
      $(".confirm").click(function(){

        let order_id = $(this).attr("order_id");
        let phone = $(this).attr("phone");
        let payment = $(this).attr("payment");
        let status = $(this).attr("status");
        let address = $(this).attr("address");
        let duureg = $(this).attr("duureg");
        let confirm_info = $(this).attr("confirm_info");



        $("b#order_id").html(order_id);
        $("b#phone").html(phone);
        $("b#duureg").html(duureg);
        $("b#address").html(address);

        $("input[name='order_id']").val(order_id);
        $("#status_op_"+status).attr("selected","selected");
        $("#payment_op_"+payment).attr("selected","selected");
        $("#confirm_info").html(confirm_info);

        $('#myModal').modal('show'); 
        });

        $(".d_button").click(function(){
        let sd = $(this).attr("data_id");
        $("input[name ='duureg']").val(sd);
        $("#s_form").submit();
    });
</script>
@endsection
