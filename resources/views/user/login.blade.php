@extends('layouts.app')

@section('content')
<form class="form-signin" method="POST" action="{{ route('authenticate') }}">
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
    <div calss="form-group">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" id="inputEmail" name="email" class="form-control"  value="{{ old('email') }}" placeholder="Email address" autofocus autocomplete="off">
       <!--  @if (!empty($errors) && isset($error['email']))
        <div class="alert alert-danger">
            {{ $errors->email }}
        </div>
        @endif -->
    </div>
    <div calss="form-group">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control"  value="{{ old('password') }}" placeholder="Password" autocomplete="off">
        <!-- @if (!empty($errors) && isset($error['email']))
        <div class="alert alert-danger">
            {{ $errors->password }}
        </div>
        @endif -->
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <div class="checkbox mb-1">
    <label>don't have account | </label> <a href="{{url('register')}}"> Register </a>
    </div>
</form>
@endsection