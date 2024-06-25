@extends('layout.common-layout')

@section('space-work')
<form action="{{ route('forgetPassword') }}" method="post">
    @csrf

    <h1>Forget Password:</h1>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p style="color: red">{{ $error }}</p>
        @endforeach
    @endif

    @if (Session::has('error'))
    <p style="color: red">{{ Session::get('error') }}</p>
    @endif
    @if (Session::has('success'))
    <p style="color: green">{{ Session::get('success') }}</p>
    @endif

    <input type="email" name="email" id="" placeholder="Enter Email">
    <br><br>
    <input type="submit" value="Forget Password">
</form>
<a href="/">Login</a>

@endsection