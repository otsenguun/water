<style>
    .active{
        background-color: #c1ebc1;
        border: 4px solid #0dfd4c;
    }
</style>
                            <h4>{!! $title !!}</h4>
                            <table class="table custom_table">
                            <thead>
                                <th>№</th>
                                    <th>Утасны дугаар</th>
                                    <th>Хаяг</th>
                                    <th>Усны тоо</th>
                                    <th>Тайлбар</th>
                                    <th>Хүргэх огноо</th>
                                    <th>Төлөв</th>
                                    <th>Төлбөр</th>

                            </thead>
                                <tbody>
                                    @foreach($orders as $key => $order)


                                   
                                    <tr class=" @if($order->phone == $phone) active @endif" class="index" data_id="{{$order->id}}">
                                        <td class="cursor"> <i class="fa-solid fa-down-left-and-up-right-to-center"></i> </td>
                                        <td>{{$order->phone}}</td>
                                        <td>{{$order->address}}</td>
                                        <td class="values">{{$order->value}}</td>
                                        <td>{{$order->info}}</td>
                                        <td>{{$order->d_date}}</td>
                                        <td>

                                            @if($order->status == 0)
                                            <span class="btn btn-sm btn-warning">Хүлээгдэж байна</span>
                                            @elseif($order->status == 1)
                                            <span class="btn btn-sm btn-success">Хүргэгдсэн {{$order->confirm_date}}</span>
                                            @else
                                            <span class="btn btn-sm btn-danger">Цуцлагдсан</span>
                                            @endif
                                          
                                            <!-- {{$order->status}} -->
                                        </td>
                                        <td>
                                            @if($order->payment == 0)
                                            <span class="btn btn-sm btn-danger">Төлөгдөөгүй</span>
                                            @elseif($order->payment == 1)
                                            <span class="btn btn-sm btn-success">Бэлэн</span>
                                            @elseif($order->payment == 2)
                                            <span class="btn btn-sm btn-primary">Данс</span>
                                            @elseif($order->payment == 3)
                                            <span class="btn btn-sm btn-warning">Дараа төлөх</span>
                                            @elseif($order->payment == 4)
                                            <span class="btn btn-sm btn-success">Урьдчилсан</span>
                                            @endif
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                        </table>
