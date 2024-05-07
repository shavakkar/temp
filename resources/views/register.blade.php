@extends('layouts')

@section('title', 'register')

@section('content')
    <div>
        <form action="{{ route('register.post') }}" method="post" style="display: flex; flex-direction: column; max-width: 400px; width:100%;" 
        >
            @csrf
            <input type="text" name="name" placeholder="name">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <div>
                <label>User
                    <input type="radio" name="userType" value="customer">
                </label>
                <label>Driver
                    <input type="radio" name="userType" value="driver">
                </label>
            </div>
            <button type="submit">Register</button>
        </form>

        <div>
            <p>Already have an Account? <a href="{{ route('login') }}">Click to login</a></p>
        </div>
    </div>
@endsection