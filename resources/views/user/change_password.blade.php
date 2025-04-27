@extends('layouts.app')

@section('content')
<form class="form-signin" method="POST" action="{{ route('update') }}">
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
     
        <label for="inputOldPassword" class="sr-only">Old Password</label>
        <input type="password" id="inputOldPassword" name="old_password" class="form-control"  value="{{ ('old_password') }}" placeholder="Old Password" autocomplete="off"> 

    <label for="inputPassword" class="sr-only">New Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control"  value="{{ old('password') }}" placeholder="New Password" autocomplete="off"> 
    
        <label for="inputConfirmedPassword" class="sr-only">Confirm Password</label>
        <input type="password" id="inputConfirmedPassword" name="password_confirmation" class="form-control"  value="{{ old('password_confirmation') }}" placeholder="Confirm Password" autocomplete="off"> 
    
    <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
    
</form>
@endsection