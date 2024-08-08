@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
    <form class="header__wrap" action="/attendance" method="get">
        @csrf
        @if (isset($previous))
            <button class="date__change-button" name="prevDate" value="{{ $previous->format('Y-m-d') }}"><</button>
        @endif
    </form>
        <p class="header__text">{{ $selectDay->format('Y-m-d') }}</p>
    <form class="header__wrap" action="/attendance" method="get">
        @csrf
        @if (isset($next))
            <button class="date__change-button" name="nextDate" value="{{ $next->format('Y-m-d') }}">></button>
        @endif
    </form>

    <div class="table__wrap">
        <table class="attendance__table">
            <tr class="table__row">
                <th class="table__header">名前</th>
                <th class="table__header">勤務開始</th>
                <th class="table__header">勤務終了</th>
                <th class="table__header">休憩時間</th>
                <th class="table__header">勤務時間</th>
            </tr>
            @foreach ($attendances as $attendance)
                <tr class="table__row">
                    <td class="table__item">{{ $attendance->name }}</td>
                    <td class="table__item">開始</td>
                    <td class="table__item">終了</td>
                    <td class="table__item">休憩時間</td>
                    <td class="table__item">勤務時間
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection