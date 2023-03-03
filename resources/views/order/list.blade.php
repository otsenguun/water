@extends('layouts.app')

@section('content')
<div class="container">


<form action="">

<div class="row">
    @foreach($duureg as $key => $dd)
<div class="col-md-1">
   <a href="{{url('show_list/'.$key)}}" class="btn btn-primary">{{$dd}}</a>
</div>
@endforeach
<div class="col-md-3">
    <label for="">Утасны дугаар</label>
    <input type="text" name="phone" class="form-control">
</div>
<div class="col-md-3">
    <label for="">Огноо</label>
    <input type="date" name="date" class="form-control" value="{{date('Y-m-d')}}">
</div>
<div class="col-md-3">
<input type="submit" value="Хайх" class="form-control">
</div>

</div>

</form>
<hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Хүргэлтүүд</div>

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
                                    <th>Төлөв</th>
                                    <th>Төлбөр</th>
                                    <th>#</th>

                            </thead>
                                <tbody>
                                    @foreach($orders as $key => $order)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$order->phone}}</td>
                                        <td>{{$duureg[$order->duureg]}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->value}}</td>
                                        <td>
                                            <select name="" id="" class="form-control">
                                                <option value="0">Хүргэгдсэн</option>
                                                <option value="1">Цуцлагдсан</option>
                                            </select>
                                            <!-- {{$order->status}} -->
                                        </td>
                                        <td>
                                            <select name="" id="" class="form-control">
                                                <option value="0">Данс</option>
                                                <option value="1">Бэлэн</option>
                                                <option value="2">Дараа төлөх</option>
                                            </select>
                                            <!-- {{$order->status}} -->
                                        </td>

                                        <td>
                                            <button class="btn btn-sm btn-primary confirm">Хадгалах</button>
                                            
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
                        <option value="1">Бэлэн</option>
                        <option value="2">Дараа төлөх</option>
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
<script>

    $(".confirm").click(function(){
        let user = $(this).attr("user_id");
        let date = $(this).attr("date");

        // $.get("{{url('createOrder')}}"+"/"+user+"/"+date, function(data, status){
        //     // alert("Data: " + data + "\nStatus: " + status);
        //     $("#order_body").html(data);
        //     // console.log(data);
        // });

        $('#myModal').modal('show'); 
    });

   

</script>
@endsection
