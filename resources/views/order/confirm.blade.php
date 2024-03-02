@extends('layouts.app')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="container">


<form action="" method="get" id="s_form">

<div class="row">
<a href="{{url('/')}}" class="btn btn-primary">Буцах</a>

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
                <div class="card-header info">

                  
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
                                        <td class="values">{{$order->value}}</td>
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
                                            <button data_id="{{$order->id}}" class="btn btn-sm btn-primary orderconfirm">Батлах</button>
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



<div class="modal fade" id="orderconfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Захиалга батлах</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="date_body">
        <form action="{{url('/confirmOrderOperator')}}" method="post">
            @csrf
            <input type="hidden" value="" name="order_id" id="ch_order_id">
            <center>
            <input type="submit" name="type" class="btn btn-success btn-sm" value = "Батлах">
            <input type="submit" name="type"  class="btn btn-danger btn-sm" value= "Цуцлах">
            </center>
          
        </form>
      
      </div>
     
    </div>
  </div>
</div>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">  -->

<script>

$(document).ready(function(){
    let total_val = 0;
    let count = 0;
        $( ".values" ).each(function( index ) {
    //    console.log("asdasd");
            let value = parseInt($(this).html());
            // console.log(value);
            total_val += value;
            count++;
        });
        $(".info").html("Захиага тоо :<b> "+count+"</b> Усний тоо :<b> "+total_val+"</b>")
    });

$(".orderconfirm").click(function(){
        let orderid = $(this).attr("data_id");
        $("#ch_order_id").val(orderid);
        // console.log("asdasd");
        $('#orderconfirm').modal('show'); 
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session()->get('info_text'))
    Swal.fire({
        title: '{{session()->get('info_text')}}',
        text: '',
        icon: 'success',
        confirmButtonText: 'Хаах'
    })
    @endif
</script>

@endsection
