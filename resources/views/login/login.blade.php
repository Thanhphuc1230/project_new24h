@extends('login.master')
@section('title', 'Login')
@section('content')
    <form action="{{ route('postLogin') }}" method="post" class="login100-form validate-form p-b-33 p-t-5">
        @csrf
        <div class="wrap-input100 validate-input" data-validate="Enter username">
            <input class="input100" type="text" name="email" placeholder="User name" value="{{ old('email') }}">
            <span class="focus-input100" data-placeholder="&#xe82a;"></span>
        </div>
        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
        </div>
        <div class="container-login100-form-btn m-t-32">
            {!! NoCaptcha::renderJs('en', false, 'recaptchaCallback') !!}
            {!! NoCaptcha::display() !!}
        </div>
        <div class="container-login100-form-btn m-t-32">
            <button class="login100-form-btn" type="submit">
                Login
            </button>
        </div>
        <div class="container-login100-form-btn m-t-32" style="display:flex; justify-content:space-around">
            <a href="{{ route('getRegister') }}" style="font-size:17px">
                Register
            </a>
            <a href="{{ route('getForgot') }}" style="font-size:17px">
                Forgot password
            </a>
        </div>
        <div class="text-center">
            <a href="{{ route('provider-auth', ['provider' => 'facebook']) }}" type="button"
                class="btn btn-secondary btn-floating mx-1">
                <i class="fa-brands fa-facebook"></i>

                <a href="{{ route('provider-auth', ['provider' => 'google']) }}" type="button"
                    class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-google"></i>
                </a>

                <a href="{{ route('provider-auth', ['provider' => 'github']) }}" type="button"
                    class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-github"></i>
                </a>
        </div>
    </form>
@endsection
