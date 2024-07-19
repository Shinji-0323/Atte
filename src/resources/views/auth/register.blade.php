@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css')}}">
@endsection

@section('content')
<div class="register-container">
    <div class="register-box">
        <h2>会員登録</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" placeholder="名前" value="{{ old('name') }}" required autofocus>
            <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="パスワード" required>
            <input type="password" name="password_confirmation" placeholder="確認用パスワード" required>
            <button type="submit">会員登録</button>
        </form>
        <a class="login-link" href="{{ route('login') }}">アカウントをお持ちの方はこちらからログイン</a>
    </div>
</div>
@endsection