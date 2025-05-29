<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>図鑑アプリ</title>
    </head>
    <body>
        <h1>動物詳細</h1>
        <h2>{{ $animal->name }}</h2>
        <p>説明：{{ $animal->description }}</p>
        <p>画像ファイル名：{{ $animal->image }}</p>
        <img src="/{{ $animal->image }}" alt="{{ $animal->name }}の画像" style="width: 160px"><br>
        <a href="/">戻る</a>
    </body>
</html>