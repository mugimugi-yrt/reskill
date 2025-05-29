<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>メモ帳アプリ</title>
    </head>
    <body>
        <h1>メモ詳細</h1>
        <h2>{{ $memo->title }}</h2>
        <!-- 改行を反映させるCSS = white-space: pre-wrap -->
        <p style="white-space: pre-wrap">{{ $memo->content }}</p>
        <p>作成日時：{{ $memo->created_at }}</p>
        <a href="{{ route('memos.edit', $memo->id) }}">編集する</a> 
        <a href="/">メモ一覧へ</a>
        <hr>
        <a href="{{ route('memos.delete', $memo->id) }}">削除する</a> 
    </body>
</html>