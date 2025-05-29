<!DOCTYPE html>
<html>
    <!-- 問題 3 : コントローラの用意 -->
    <!-- 共通となるレイアウトテンプレート -->
    <head>
        <meta charset="utf-8">
        <!-- タイトル要素を @section('title') から指定可能 (問題 3) -->
        <title>@yield('title')</title>
    </head>
    <body>
        <header>
            <!-- タイトルと同じ名前がhtmlにも出現するようにする -->
            <h1>@yield('title')</h1>
        </header>
        <!-- htmlの中身は @section('content')から指定可能 -->
        <main>
            @yield('content')
        </main>
    </body>
</html>