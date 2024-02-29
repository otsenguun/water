

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
                <a class="btn btn-default btn-sm" href="{{url('OrderPersonList')}}">Миний захиалга</a> 
                <a class="btn btn-primary btn-sm" href="{{url('OrderPerson')}}">Шинэ захиалга</a> 


             <hr> <label for="">Утасны дугаар / <b>{{$person->phone}}</b>  / <a href="{{url('logoutPerson')}}" class="btn btn-warning btn-sm">Өөр хэрэглэгчээр нэвтрэх</a></label></center>
           
        <form action="confirmOrderPerson" method="post">
            @csrf
           
            <input type="hidden" class="form-control" name="phone" value="{{$person->phone}}">
            <input type="hidden" class="form-control" name="person_id" value="{{$person->id}}">

            <br>
            <label for="">Дүүрэг сонгоно уу</label>
            <select name="duureg" id="" class="form-control" required>
                @foreach($duuregs as $key => $du)
                <option @if($person->duureg == $key) selected @endif value="{{$key}}">{{$du}}</option>
                @endforeach
            </select>
            <label for="">Хаяг оруулна уу</label>
            <textarea name="address" class="form-control" name="" id="" cols="10" rows="5" required>{{$person->address}}</textarea>
            <label for="">Төлбөрийн хэлбэр</label>
            <select name="payment" id="" class="form-control">
                @foreach($payments as $pkey => $pay)
                <option value="{{$pkey}}">{{$pay}}</option>
                @endforeach
            </select>
            Хүлээн авах огноо
            <input type="date" name="d_date" value="{{date('Y-m-d')}}" class="form-control">
            <br>
            <center>

            <input type="submit"  value="Захиалах" class="btn btn-primary">
          
            </center>
            
        </form>
        </div>
       
        </div>
        
</div>

@endsection