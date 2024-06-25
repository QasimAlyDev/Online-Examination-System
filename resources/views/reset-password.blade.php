@extends('layout.common-layout')

@section('space-work')


<form action="{{ route('resetPassword') }}" method="post">
    @csrf
    
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p style="color: red">{{ $error }}</p>
        @endforeach
    @endif

    <h1>Reset Password:</h1>
    <input type="hidden" name="id" value="{{ $user[0]['id'] }}">
    <input type="password" name="password" id="" placeholder="Enter Password">
    <br><br>
    <input type="password" name="password_confirmation" id="" placeholder="Enter Confirm Password">
    <br><br>
    <input type="submit" value="Reset Password">
</form>

@endsection