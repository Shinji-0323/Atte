@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="header__wrap">
    <span class="header__text">
        会員登録
    </span>
</div>

<form class="form__wrap" action="{{ route('register') }}" method="post">
    @csrf
    <div class="form__content">
        <div class="form__item">
            <input class="form__input" type="text" name="name" placeholder="名前" value="{{ old('name') }}">
        </div>
        <div class="error__item">
            @error('name')
                <span class="error__message">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form__content">
        <div class="form__item">
            <input class="form__input" type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
        </div>
        <div class="error__item">
            @error('email')
                <span class="error__message">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form__content">
        <div class="form__item">
            <input class="form__input" type="password" name="password" placeholder="パスワード">
        </div>
        <div class="error__item">
            @error('password')
                <span class="error__message">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form__item">
        <input class="form__input" type="password" name="password_confirmation" placeholder="確認用パスワード">
    </div>
    <div class="form__item form__item-button">
        <button class="form__input form__input-button">会員登録</button>
    </div>
</form>

<div class="login__wrap">
    <div class="login__item">
        <p class="login__item-text">
            アカウントをお持ちの方はこちらから
        </p>
    </div>
    <div class="login__button">
        <a class="login__item-button" href="/login">ログイン</a>
    </div>
</div>
@endsection