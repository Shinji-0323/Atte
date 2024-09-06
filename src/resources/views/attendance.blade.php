@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
    <form class="header__wrap" action="/attendance" method="post">
        @csrf
            <button class="date__change-button" name="prevDate"><</button>
            <input type="hidden" name="displayDate" value="{{ $displayDate }}">
            <p class="header__text">{{ $displayDate->format('Y-m-d') }}</p>
            <button class="date__change-button" name="nextDate">></button>
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
            @php
                $pageNumber = ($attendances->currentPage() - 1) * $attendances->perPage() + 1;
            @endphp
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
                @php
                    $pageNumber++;
                @endphp
            @endforeach
        </table>
    </div>
    {{ $attendances->appends(['displayDate' => $displayDate->toDateString()])->links('pagination::bootstrap-4') }}
@endsection