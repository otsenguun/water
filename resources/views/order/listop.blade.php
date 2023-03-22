@extends('layouts.app')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="container">


<form action="" method="get" id="s_form">

<div class="row">
<a href="{{url('not_list')}}" class="btn btn-primary">Хувиарлаагүй жагсаалт</a>

<hr>
<div class="row col-md-12">
<div class="col-md-1">
  
  <button class="btn btn-primary d_button" type="button" data_id ="">
        Бүгд
  </button>
 </div>
    @foreach($duureg as $key => $dd)
    <div class="col-md-1">
  
     <button class="btn btn-primary d_button" type="button" data_id ="{{$key}}" @if($request->duureg == $key) disabled @endif>
            {{$dd}}
     </button>
    </div>
    @endforeach
</div>
<input type="hidden" name="duureg" value="{{$request->duureg}}">

<div class="col-md-3">
    <label for="">Хүргэх ажилтан</label>
    <select name="d_user" id="" class="form-control">
        <option value="">-бүгд-</option>
        @foreach($users as $user)
        <option value="{{$user->id}}" @if($request->d_user == $user->id) selected @endif>{{$user->name}}</option>
        @endforeach
    </select>
</div>

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
                <div class="card-header">Хүргэлтүүд
                   <a href="{{url('/')}}" class="btn btn-primary">Хүргэлт үүсгэх</a>
                </div>

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
                                    <th>Үүсгэсэн</th>
                                    <th>Ажилтан</th>
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
                                        <td>{{$order->user($order->c_user)->name}}</td>
                                        <td>{{$order->user($order->d_user)->name}}</td>
                                        <td>{{$order->phone}}</td>
                                        <td>{{$duureg[$order->duureg]}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->value}}</td>
                                        <td>{{$order->info}}</td>
                                        <td>{{$order->d_date}}</td>
                                        <td>

                                            @if($order->status == 0)
                                            <span class="btn btn-warning btn-sm">Хүлээгдэж байна</span>
                                            @elseif($order->status == 1)
                                            <span class="btn btn-success btn-sm">Хүргэгдсэн</span>
                                            @else
                                            <span class="btn btn-danger btn-sm">Цуцлагдсан</span>
                                            @endif
                                          
                                            <!-- {{$order->status}} -->
                                        </td>
                                        <td>
                                            @if($order->payment == 0)
                                            <span class="btn btn-danger btn-sm">Төлөгдөөгүй</span>
                                            @elseif($order->payment == 1)
                                            <span class="btn btn-success btn-sm">Бэлэн</span>
                                            @elseif($order->payment == 2)
                                            <span class="btn btn-primary btn-sm">Данс</span>
                                            @elseif($order->payment == 3)
                                            <span class="btn btn-warning btn-sm">Дараа төлөх</span>
                                            @elseif($order->payment == 4)
                                            <span class="btn btn-success btn-sm">Урьдчилсан</span>
                                            @endif
                                        </td>


                                        <td>
                                            <button data_id="{{$order->id}}" class="btn btn-sm btn-primary changedate">Огноо солих</button>
                                            <a class="btn btn-info btn-sm" href="{{route('order.edit',$order->id)}}">Засах</a>
                                            <a class="btn btn-info btn-sm" href="{{route('order.show',$order->id)}}">Харах</a>
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
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Захиалга батлах</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="order_body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="">Тайлбар</label>
                    <textarea class="form-control" name="" id="" cols="30" rows="10">

                    </textarea>
                </div>
                <div class="mb-3">
                    <select name="" id="" class="form-control">
                        <option value="0">Хүргэгдсэн</option>
                        <option value="1">Цуцлагдсан</option>
                    </select>
                </div>
                <div class="mb-3">
                    <select name="" id="" class="form-control">
                        <option value="0">Данс</option>
                        <option value="1">Данс</option>
                        <option value="2">Бэлэн</option>
                        <option value="3">Дараа төлөх</option>
                    </select>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-sm" value="Хадгалах">
                </div>

            </form>
      </div>
     
    </div>
  </div>
</div>


<div class="modal fade" id="changedate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Хүргэх өдөр солих</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="date_body">
        <form action="{{url('/change_date')}}" method="post">
            <label for="">Огноо</label>
            @csrf
            <input type="date" name="ch_date" class="form-control" value="{{date('Y-m-d')}}">
            <input type="hidden" value="" name="order_id" id="ch_order_id">
            <input type="submit" value = "Хадгалах">
        </form>
      
      </div>
     
    </div>
  </div>
</div>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">  -->

<script>

$(".changedate").click(function(){
        let orderid = $(this).attr("data_id");
        $("#ch_order_id").val(orderid);
        // console.log("asdasd");
        $('#changedate').modal('show'); 
    })
</script>
		


<script>

    $(".d_button").click(function(){
        let sd = $(this).attr("data_id");
        $("input[name ='duureg']").val(sd);
        $("#s_form").submit();
    });

    $(".confirm").click(function(){
        let user = $(this).attr("user_id");
        let date = $(this).attr("date");
        $('#myModal').modal('show'); 
    });

   

</script>
@endsection
