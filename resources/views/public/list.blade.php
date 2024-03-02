

@extends('layouts.publicapp')

@section('content2')


<div class="container">
    <div class="card">
        <div class="card-header">
        <img src="https://cdn.greensoft.mn/uploads/site/673/site_config/logo/d52a522716fa24908e70ca2ec347c251d46a3bf4.jpg" style="width:200px;" alt="ospring.mn">
            <!-- Ус захиалах -->
        </div>
        <div class="card-body">
             <center> 
                <a class="btn btn-primary btn-sm" href="{{url('OrderPersonList')}}">Миний захиалга</a> 
                <a class="btn btn-default btn-sm" href="{{url('OrderPerson')}}">Шинэ захиалга</a> 
             
             <hr> <label for="">Утасны дугаар / <b>{{$person->phone}}</b>  / <a href="{{url('logoutPerson')}}" class="btn btn-primary btn-sm">Өөр хэрэглэгчээр нэвтрэх</a></label></i></center>


             <div class ="table-responsive">

             <table class="table">
                <th>№</th>
                <th>Хүргнэх огноо</th>
                <th>Төлөв</th>
                <!-- <th>Хаяг</th> -->
              
                <!-- <th>Утас</th> -->
                <th>Ус тоо/ш</th>
                <th>Дүүрэг</th>
                <th>Үүсгэсэн</th>
                @foreach($orders as $key => $order)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$order->d_date}}</td>
                    <td>
                        
                        @if($order->isconfirmed == 2 && $order->status == 0)
                        <button class="btn btn-info btn-sm">Баталгаажсан</button> 
                        @elseif($order->status == 1)
                        <button class="btn btn-success btn-sm"> {{$order->status()}} </button> 
                        @elseif($order->isconfirmed == 1 && $order->status == 0)
                        <button class="btn btn-warning btn-sm"> {{$order->status()}} </button> 
                        @else
                        <button class="btn btn-danger btn-sm"> {{$order->status()}} </button> 
                        @endif
                        </td>
                    <td>{{$order->value}}</td>
                    <!-- <td>{{$order->address}}</td> -->
                    <td>{{$order->duureg()}}</td>
                    <!-- <td>{{$order->phone}}</td> -->
                   
                    <td>{{$order->created_at}}</td>
                   
                </tr>
                @endforeach
             </table>

             </div>
       
        </div>
       
        </div>
        
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session()->get('info_text'))
    Swal.fire({
        title: '{{session()->get('info_text')}}',
        text: 'Захиалгын явцыг ( Миний захиалга ) цэснээс харна уу.',
        icon: 'success',
        confirmButtonText: 'Хаах'
    })
    @endif
</script>


@endsection