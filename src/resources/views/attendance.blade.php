@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<div class="header">
    <form class="header__wrap" action="/attendance" method="post">
        @csrf
        @if (isset($previous))
            <button class="date__change-button" name="prevDate" value="{{ $previous->format('Y-m-d') }}"><</button>
        @endif
    </form>
        <input type="hidden" name="displayDate" value="{{ $selectDay }}">
        <p class="header__text">{{ $selectDay->format('Y-m-d') }}</p>
    <form class="header__wrap" action="/attendance" method="get">
        @csrf
        @if (isset($next))
            <button class="date__change-button" name="nextDate" value="{{ $next->format('Y-m-d') }}">></button>
        @endif
    </form>
</div>

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
                <td class="table__item">{{ $attendance->work_start }}</td>
                <td class="table__item">{{ $attendance->work_end }}</td>
                @php
                    $rest_start = strtotime($attendance->rest_start);
                    $rest_end = strtotime($attendance->rest_end);
                    $restTimeDiff = $rest_end - $rest_start;
                    $formattedRestTime = gmdate('H:i:s', $restTimeDiff);
                    $restTime = $formattedRestTime;
                @endphp
                <td class="table__item">{{ $restTime }}</td>
                @php
                    $work_start = strtotime($attendance->work_start);
                    $work_end = strtotime($attendance->work_end);
                    $workTimeDiff = $work_end - $work_start - $restTimeDiff;
                    $formattedWorkTime = gmdate('H:i:s', $workTimeDiff);
                    $workTime = $formattedWorkTime;
                @endphp
                <td class="table__item">{{ $workTime }}</td>
            </tr>
        @endforeach
    </table>
    <div class="table-page">
        <div class="table-pagination">
            {{ $attendances->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection