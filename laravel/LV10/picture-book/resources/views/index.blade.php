<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>図鑑アプリ</title>
    </head>
    <body>
        <h1>動物一覧</h1>
        @foreach ($animals as $animal)
            <p><a href="/animals/{{ $animal->id }}">{{ $animal->name }}</a></p>
        @endforeach
    </body>
</html>