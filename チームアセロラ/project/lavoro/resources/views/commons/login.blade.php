<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/member_info.css">
</head>

<body>
    <h1 class="text">@yield('title')</h1>
    @include('commons.flash')
    <div class="login-form">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <p>
                <label>メールアドレス</label>
                <input type="email" name="email"><br>
            </p>
            <p>
                <label>パスワード</label>
                <input type="password" name="password"><br>
            </p>
            <p>
                <button type="submit">ログイン</button>
            </p>
        </form>
    </div>
    <div class="text">
        @yield('links')
    </div>
</body>
</html>