@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{route('plan.create')}}" class="btn btn-primary">Захиалга бүртгэх</a>
<a href="{{route('user.create')}}" class="btn btn-primary">Ажилтан бүртгэх</a>
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
                                                <a href="{{url('createOrder',$user->id,$dd)}}" class="btn btn-success">Захиалга <span class="badge badge-primary"> <b>{{$user->orders($user->id,$dd)}}</b></span> </a>
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
@endsection
