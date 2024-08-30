@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
    <link rel="stylesheet" href="{{ asset('css/users_data.css') }}">
@endsection

@section('content')
    <form class="header__wrap" action="" method="post">
        @csrf

        @if($displayUser != null)
            <p class="header__text">{{ $displayUser}} さんの勤怠表</p>
        @else
            <p class="header__text">ユーザーを選択してください</p>
        @endif

        <div class="search__item">
            <input class="search__input" type="text" name="search_name" placeholder="名前検索" value="{{ $searchParams['name'] ?? '' }}" list="user_list">
            <datalist id="user_list">
                @if($userList)
                    @foreach($userList as $user)
                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                    @endforeach
                @endif
            </datalist>
            <button class="search__button">検索</button>
        </div>
    </form>

    <div class="table__wrap">
        <table class="attendance__table">
            <tr class="table__row">
                <th class="table__header">日付</th>
                <th class="table__header">勤務開始</th>
                <th class="table__header">勤務終了</th>
                <th class="table__header">休憩時間</th>
                <th class="table__header">勤務時間</th>
            </tr>
            @foreach ($attendances as $attendance)
                <tr class="table__row">
                    <td class="table__item">{{ $attendance->date }}</td>
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
    </div>
    {{ $attendances->appends(request()->query())->links('pagination::bootstrap-4') }}
@endsection