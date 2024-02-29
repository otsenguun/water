

@extends('layouts.publicapp')

@section('content2')


<div class="container">
    <div class="card">
        <div class="card-header">
        <img src="https://cdn.greensoft.mn/uploads/site/673/site_config/logo/d52a522716fa24908e70ca2ec347c251d46a3bf4.jpg" style="width:200px;" alt="ospring.mn">
            <!-- Ус захиалах -->
        </div>
        <div class="card-body">
             <center>  <i>Бүртгэлтэй үүсгэх</i></center>
           
        <form action="RegisterPersonSubmit" method="post">
            @csrf
            <label for="">Утасны дугаар</label>
            <input type="text" class="form-control" name="phone" required>
            <label for="">Нууц үг</label>
            <input type="password" class="form-control" name="password" required>
            <label for="">Дүүрэг</label>
            <select name="duureg" id="" class="form-control" required>
                @foreach($duuregs as $key => $du)
                <option value="{{$key}}">{{$du}}</option>
                @endforeach
            </select>
            <label for="">Хаяг</label>
            <textarea name="address" class="form-control" name="" id="" cols="10" rows="5" required></textarea>
            <br>
            <center>

            <input type="submit"  value="Бүртгүүлэх" class="btn btn-primary">
          
            </center>
            
        </form>
        </div>
       
        </div>
        
</div>

@endsection