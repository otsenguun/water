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

                            </thead>

                        </table>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
