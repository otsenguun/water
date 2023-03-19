@extends('layouts.app')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="container">

<hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ажилтан
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">

                  
                        <table class="table">
                            <thead>
                                <th>№</th>
                                    <th>Нэр</th>
                                    <th>Нэвтрэх email</th>
                                    <th>#</th>

                            </thead>
                                <tbody>
                                    @foreach($users as $key => $user)
                                    <tr class="index" data_id="{{$user->id}}">
                                        <td>{{$key+1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{route('user.edit',$user->id)}}">Засах</a>
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
