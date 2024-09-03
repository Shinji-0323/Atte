<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    @yield('css')
</head>

<body>
    <header>
        <div class="header__left">
            <span class="header__logo">Atte</span>
        </div>
        <div class="header__right">
            <ul class="header__right-list">
                @if (Auth::check())
                    <li class="header__right-item">
                        <a class="header__item-link" href="/">ホーム</a>
                    </li>
                    <li class="header__right-item">
                        <a class="header__item-link" href="/attendance">日付一覧</a>
                    </li>
                    <li class="header__right-item">
                        <a class="header__item-link" href="/user">ユーザー一覧</a>
                    </li>
                    <li class="header__right-item">
                        <a class="header__item-link" href="/users/data/{id}">勤怠表</a>
                    </li>
                    <li class="header__right-item">
                        <form action="/logout" method="post">
                            @csrf
                            <button class="header__item-link" type="submit">ログアウト</button>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer__item">
            <small class="footer__text">
                Atte,inc.
            </small>
        </div>
    </footer>
</body>

</html>