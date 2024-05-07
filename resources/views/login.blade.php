@extends('layouts')

@section('title', 'login')

@section('content')
    <div>
        <form action="{{ route('login.post') }}" method="post" style="display: flex; flex-direction: column; max-width: 400px; width:100%;" 
        >
            @csrf
            <input type="email" name="email">
            <input type="password" name="password">
            <div>
                <label>User
                    <input type="radio" name="userType" value="customer">
                </label>
                <label>Driver
                    <input type="radio" name="userType" value="driver">
                </label>
            </div>
            <button type="submit">Login</button>
        </form>

        <div>
            <p>Don't have an Account? <a href="{{ route('register') }}">Click to Register</a></p>
        </div>
    </div>
@endsection