@extends('login.master')
@section('title', 'Send mail')
@section('content')
    <form class="login100-form validate-form p-b-33 p-t-5">
        <div class="wrap-input100 validate-input">
            <span class="login100-form-title p-b-41" style=" font-size: 20px; color: #333;text-transform:none">Email has been
                sent, please check
                your email</span>
        </div>
        <div class="container-login100-form-btn m-t-32">
            <a href="{{ route('getLogin') }}" type="button" class="login100-form-btn">Login</a>

        </div>
    </form>
@endsection
