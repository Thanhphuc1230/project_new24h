@extends('login.master')
@section('title', 'Reset Password')
@section('content')
    <form action="{{ route('resetPassword') }}" method="post" class="login100-form validate-form p-b-33 p-t-5">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="form-control" type="hidden" name="email" value="{{ $email ?? old('email') }}"
                placeholder="E-mail Address" required>
        </div>
        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="input100" type="password" name="password" placeholder="Enter password">
            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
        </div>
        <div class="wrap-input100 validate-input" data-validate="Enter password confirm">
            <input class="input100" type="password" name="password_confirmation" placeholder="Password confirm">
            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
        </div>
        <div class="container-login100-form-btn m-t-32">
            <button class="login100-form-btn" type="submit">
                Reset password
            </button>
        </div>

    </form>
@endsection
