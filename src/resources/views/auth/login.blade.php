@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css')}}">
@endsection

@section('content')
<div class="login-container">
    <div class="login-box">
        <h2>ログイン</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="メールアドレス" required autofocus>
            <input type="password" name="password" placeholder="パスワード" required>
            <button type="submit">ログイン</button>
        </form>
        <a class="register-link" href="{{ route('register') }}">アカウントをお持ちでない方はこちらから会員登録</a>
    </div>
</div>
@endsection