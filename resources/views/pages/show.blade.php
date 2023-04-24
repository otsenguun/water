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
                   <b>user : {{$log->c_user}}</b>  <br>
                   <b>log date : {{$log->created_at}}</b> 
                    <pre>
                    {{
                        print_r(json_decode($log->data));
                    }}
                    </pre>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
