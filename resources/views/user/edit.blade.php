@extends('layouts.app')

@section('content')
<div class="container">

<hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Хэрэглэгч засах</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('user.update',$user->id)}}" method="post">
                    {{ method_field('PUT') }}
      
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input value="{{$user->name }}" type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input value="{{$user->email }}" type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    @if( Auth::user()->id == 1 )
                    <div class="mb-3">
                       
                        <label for="exampleInputEmail1" class="form-label">Төрөл</label>
                        <select name="type" id="" class="form-control">
                            <option value="0" @if($user->type ==0) selected @endif>Оператор</option>
                            <option value="1"  @if($user->type ==1) selected @endif>Ажилтан</option>
                        </select>
                       
                    </div>
                    @else
                    
                    <input type="hidden" name="type" value="1">
                    @endif
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                  
                    @csrf
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
