@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{url('export-orders')}}" method="get">
        <input type="date" value="{{date('Y-m-d')}}" name="date1">
        <input type="date" value="{{date('Y-m-d')}}" name="date2">
        <button type="submit" class="btn btn-success">Тайлан татах</button>
    </form>

<hr>
<a href="{{route('user.create')}}" class="btn btn-primary">Ажилтан бүртгэх</a>
<a href="{{url('show_list')}}" class="btn btn-primary">Захиалга жагсаалт</a>
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

    $(document).on( "keyup","#phones", function() {
        let phone = $( this ).val();
        if(phone.length >=6){
            $.get("{{url('searchOrder')}}"+"/"+phone, function(data, status){
            // alert("Data: " + data + "\nStatus: " + status);
                // $("#order_body").html(data);
             
                let response = JSON.parse(data);
                // console.log(response);
                    $("#search_val").empty();
                    let valhtml = "";
                    $.each( response, function( index,value ){
                        valhtml += "<li phone= '"+ index +"' duureg_key= '"+ value.duureg_key +"' address= '"+ value.address +"' class='list-group-item btn btn-sm btn-info set_info'>"+index +" : " + value.duureg + " :" + value.address + "</li>";
                    });
                    $("#search_val").html(valhtml);
            });
        }

    });

    $(document).on( "click",".set_info", function() {
        let phone = $(this).attr("phone");
        let duureg_key = $(this).attr("duureg_key");
        let address = $(this).attr("address");
        $("#search_val").empty();

        console.log(address);
        $("#dd_"+duureg_key).attr("selected","selected");
        $("#phones").val(phone);
        // $("select[name='duureg_key']").val(duureg_key);
        $("#s_address").val(address);
    });

</script>
@endsection
