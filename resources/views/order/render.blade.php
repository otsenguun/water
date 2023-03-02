


<h6>Ажилтан : <b>{{ $del->name}}</b>  </h6>
<h6>Хүргэх дгноо : <b>{{ $date}}</b>  </h6>

<form action="{{route('order.store')}}" method="post">

  <div class="form-group">
    <label for="exampleFormControlInput1">Утасны дугаар</label>
    <input type="number" name="phone" class="form-control" id="exampleFormControlInput1" placeholder="Утас">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Дүүрэг</label>
    <select class="form-control" id="exampleFormControlSelect1" name="duureg">
        @foreach($duuregs as $d_id => $duureg)
            <option value="{{$d_id}}">{{$duureg}}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Хаяг</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name ="address"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Тоо/ш</label>
    <input type="number" name ="value" class="form-control">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Захиалгын тухай</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name ="info"></textarea>
  </div>
  <input type="hidden" name="c_user" value=" {{ Auth::user()->id }}">
  <input type="hidden" name="d_user" value=" {{ $del->id }}">
  <input type="hidden" name="d_date" value=" {{ $date }}">
  @csrf
  <hr>
  <div class="text-center"><input type="submit" value="Хадгалах"  class="btn btn-primary"></div>
  
</form>


