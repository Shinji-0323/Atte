@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
<div class="header__wrap">
    <p class="header__text">
    さんお疲れ様です！
    </p>
</div>

<form class="form__wrap">
    <div class="form__item">
        <button  class="form__item-button">勤務開始</button>
    </div>
    <div class="form__item">
        <button  class="form__item-button">勤務終了</button>
    </div>
    <div class="form__item">
        <button  class="form__item-button">休憩開始</button>
    </div>
    <div class="form__item">
        <button  class="form__item-button">休憩終了</button>
    </div>
</form>

@endsection