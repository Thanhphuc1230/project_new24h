@extends('login.master')
@section('title', 'Forgot Password')
@section('content')
    <form action="{{ route('sendResetLink') }}" method="post" class="login100-form validate-form p-b-33 p-t-5">
        @csrf
        <div class="wrap-input100 validate-input" data-validate="Email">
            <input class="input100" type="text" name="email" placeholder="Email forgot">
            <span class="focus-input100" data-placeholder="&#xe82a;"></span>
        </div>
        <div class="container-login100-form-btn m-t-32">
            <button class="login100-form-btn" type="submit">
                Forgot password
            </button>
        </div>
        <div class="container-login100-form-btn m-t-32" style="display:flex; justify-content:space-around">
            <a href="{{ route('getLogin') }}" style="font-size:17px">
                Login
            </a>
            <a href="{{ route('getRegister') }}" style="font-size:17px">
                Register
            </a>
        </div>
    </form>
@endsection
