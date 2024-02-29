

@extends('layouts.publicapp')

@section('content2')


<div class="container">
    <div class="card">
        <div class="card-header">
        <img src="https://cdn.greensoft.mn/uploads/site/673/site_config/logo/d52a522716fa24908e70ca2ec347c251d46a3bf4.jpg" style="width:200px;" alt="ospring.mn">
            <!-- Ус захиалах -->
        </div>
        <div class="card-body">
             <center>  <i style="font-size:13px">Бүртгэлтэй утасны дугаараар нэвтэрч орсоноор та ус захиалах боломжтой</i></center>
           
        <form action="LoginPerson" method="post">
            @csrf
            <label for="">Утасны дугаар</label>
            <input type="text" class="form-control" name="phone" value = "@if(session()->get('old_phone')) {{session()->get('old_phone')}} @endif">
            <label for="">Нууц үг</label>
            <input type="password" class="form-control" name ="password">
            <br>
            <center>

            <input type="submit"  value="Нэвтрэх" class="btn btn-primary">
            <p>Хэрэв та бүртгэлгүй бол  <b><a href="{{url('RegisterPerson')}}">Энд</a></b> дарж бүртгүүлнэ үү </p>
            </center>
            
        </form>
        </div>
       
        </div>
        
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session()->get('info_text'))
    Swal.fire({
        title: '{{session()->get('info_text')}}',
        text: 'Дахин оролдон уу',
        icon: 'error',
        confirmButtonText: 'Хаах'
    })
    @endif
</script>
@endsection