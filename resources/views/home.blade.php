@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{route('plan.create')}}" class="btn btn-primary">Захиалга бүртгэх</a>
<a href="{{route('user.create')}}" class="btn btn-primary">Ажилтан бүртгэх</a>
<a href="{{url('show_list/0')}}" class="btn btn-primary">Захиалга жагсаалт</a>
<hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">

                  
                        <table class="table">
                            <thead>
                                <th>Ажилтан</th>
                                @foreach($date_arr as $dd)
                                    <th>{{$dd}}</th>
                                @endforeach

                            </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        @foreach($date_arr as $dd)
                                            <th>
                                                 <button class="btn btn-success order" user_id ="{{$user->id}}" date="{{$dd}}">
                                                 Захиалга <span class="badge badge-primary"> <b>{{$user->orders($user->id,$dd)}}</b></span>
                                                 </button>
                                            </th>
                                        @endforeach
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
        <h5 class="modal-title" id="exampleModalLongTitle">Захиалга оруулах</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="order_body">
        ...
      </div>
     
    </div>
  </div>
</div>
<script>

    $(".order").click(function(){
        let user = $(this).attr("user_id");
        let date = $(this).attr("date");

        $.get("{{url('createOrder')}}"+"/"+user+"/"+date, function(data, status){
            // alert("Data: " + data + "\nStatus: " + status);
            $("#order_body").html(data);
            // console.log(data);
        });

        $('#myModal').modal('show'); 
    });

   

</script>
@endsection
