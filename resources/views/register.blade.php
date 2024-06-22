@extends('layout.common-layout')

@section('space-work')
<form action="{{ route('studentRegister') }}" method="post">
    @csrf

    <h1>Register:</h1>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color: red">{{ $error }}</p>
        @endforeach
    @endif

    <input type="text" name="name" id="" placeholder="Enter Name">
    <br><br>
    <input type="email" name="email" id="" placeholder="Enter Email">
    <br><br>
    <input type="password" name="password" id="" placeholder="Enter Password">
    <br><br>
    <input type="password" name="password_confirmation" id="" placeholder="Enter Confirm Password">
    <br><br>
    <input type="submit" value="register">
</form>

@if (Session::has('success'))
    <p style="color: green">{{ Session::get('success') }}</p>
@endif

@endsection