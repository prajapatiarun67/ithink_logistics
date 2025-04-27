@extends('layouts.app')

@section('content')
<form class="form-signin" method="POST" action="{{ route('store') }}">
    @csrf
    <img class="mb-8" src="https://itl-dashboard-aws.s3.ap-south-1.amazonaws.com/my/theme2/assets/images/itl-logo.svg" alt="" width="72" height="72"> 
    @if (session('message') && count($errors->all()) == 0)
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    
        <label for="inputName" class="sr-only">Name</label>
        <input type="text" id="inputName" name="name" class="form-control"  value="{{ old('name') }}" placeholder="Enter Name" autofocus autocomplete="off"> 
    
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control"  value="{{ old('email') }}" placeholder="Email address" autofocus autocomplete="off"> 
    
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control"  value="{{ old('password') }}" placeholder="Password" autocomplete="off"> 
    
        <label for="inputConfirmedPassword" class="sr-only">Password</label>
        <input type="password" id="inputConfirmedPassword" name="password_confirmation" class="form-control"  value="{{ old('password_confirmation') }}" placeholder="Password" autocomplete="off"> 
    
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
    <div class="checkbox mb-1">
        <label>Already have account | </label><a href="{{url('login')}}"> Login </a>
    </div>
</form>
@endsection