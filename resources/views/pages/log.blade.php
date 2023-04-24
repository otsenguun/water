@extends('layouts.app')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="container">

<hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Программын түүх
                </div>

                <div class="card-body">

                <form action="{{route('log.index')}}" method="get">
                    <label for="">Төрөл</label>
                    <select name="type" id="">
                        <option value="">-Бүгд-</option>
                        @foreach($log_types as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <label for="">Огноо</label>
                    <input type="date" value="{{$s_date}}">
                    <input type="submit" value="хайх" class="btn btn-sm btn-primary">
                </form>
                <hr>
                    <div class="table-responsive">
                  
                        <table class="table">
                            <thead>
                                <th>№</th>
                                    <th>Хэрэглэгч</th>
                                    <th>Төрөл</th>
                                    <th>Огноо</th>

                            </thead>
                                <tbody>
                                    @foreach($logs as $key => $log)
                                    <tr class="index" data_id="{{$log->id}}">
                                        <td>{{$key+1}}</td>
                                        <td>{{$log->c_user}}</td>
                                        <td>{{$log_types[$log->type]}}</td>
                                        <td>{{$log->created_at}}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{route('log.show',$log->id)}}">Харах</a>
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


@endsection
