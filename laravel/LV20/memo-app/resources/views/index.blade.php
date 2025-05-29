<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>メモ帳アプリ</title>
    </head>
    <body>
        <h1>メモ一覧</h1>
        <p><a href="{{ route('memos.create') }}">新規メモ作成</a></p>
        @foreach ($memos as $memo)
            <p><a href="{{ route('memos.show', $memo->id) }}">{{ $memo->title }}</a></p>
        @endforeach
    </body>
</html>