


<h6>Ажилтан : <b>{{ $del->name}}</b>  </h6>
<h6>Хүргэх дгноо : <b>{{ $date}}</b>  </h6>

<form action="{{route('order.store')}}" method="post" autocomplete="off">

  <div class="form-group">
    <label for="exampleFormControlInput1">Утасны дугаар</label>
    <input type="number" name="phone" class="form-control" id="phones" placeholder="Утас" maxlength="8">
  </div>
  <div class="mb-3">
    <hr>
  <ul id="search_val" class="list-group"></ul>
  </div>

  <div class="form-group">
    <label for="exampleFormControlSelect1">Дүүрэг</label>
    <select class="form-control" id="exampleFormControlSelect1" name="duureg" required>
      <option value="">--Сонго--</option>
        @foreach($duuregs as $d_id => $duureg)
            <option id="dd_{{$d_id}}" value="{{$d_id}}">{{$duureg}}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group">  
    <label for="exampleFormControlSelect2">Хаяг</label>
    <textarea id="s_address" class="form-control" id="exampleFormControlTextarea1" rows="3" name ="address"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Хүргэх огноо</label>
    <input type="date" name ="d_date" class="form-control" value="{{ $date }}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Тоо/ш</label>
    <input type="number" name ="value" class="form-control">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Төлбөр</label>
        <select name="payment" id="" class="form-control">
            <option value="0" id="payment_op_0">Төлөгдөөгүй</option>
            <option value="1" id="payment_op_1">Бэлэн</option>
            <option value="2" id="payment_op_2">Данс</option>
            <option value="3" id="payment_op_3">Дараа төлөх</option>
            <option value="4" id="payment_op_4">Урьдчилсан</option>
        </select>
    <!-- <input type="number" name ="value" class="form-control"> -->
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Захиалгын тухай</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name ="info"></textarea>
  </div>
  <input type="hidden" name="c_user" value=" {{ Auth::user()->id }}">
  <input type="hidden" name="d_user" value=" {{ $del->id }}">
  @csrf
  <hr>
  <div class="text-center"><input type="submit" value="Хадгалах"  class="btn btn-primary"></div>
  
</form>


