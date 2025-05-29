<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>メモ帳アプリ</title>
    </head>
    <body>
        <h1>メモ削除確認</h1>
        <h2>タイトル：{{ $memo->title }}</h2>
        <p>このメモを本当に削除しますか？</p>
        <form action="{{ route('memos.destroy', $memo->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit">削除する</button>
        </form>
        <hr>
        <a href="{{ route('memos.show', $memo->id) }}">キャンセル</a>
    </body>
</html>