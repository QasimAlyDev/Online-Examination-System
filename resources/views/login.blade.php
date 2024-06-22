@extends('layout.common-layout')

@section('space-work')
<form action="{{ route('userLogin') }}" method="post">
    @csrf

    <h1>Login:</h1>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p style="color: red">{{ $error }}</p>
        @endforeach
    @endif

    @if (Session::has('error'))
    <p style="color: red">{{ Session::get('error') }}</p>
    @endif

    <input type="email" name="email" id="" placeholder="Enter Email">
    <br><br>
    <input type="password" name="password" id="" placeholder="Enter Password">
    <br><br>
    <input type="submit" value="Login">
</form>


@endsection