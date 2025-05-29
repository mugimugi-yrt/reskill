<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>メモ帳アプリ</title>
    </head>
    <body>
        <h1>メモの編集</h1>
        <form action="{{ route('memos.update', $memo->id) }}" method="post">
            @csrf
            @method('patch')
            <dl>
                <dt>タイトル</dt>
                <!-- HTMLで入力チェックをするなら required属性 -->
                <dd><input type="text" name="title" value="{{ $memo->title }}" required></dd>
                <dt>本文</dt>
                <!-- textareaに最初から値を入れる場合はタグで囲む -->
                <dd><textarea name="content" required>{{ $memo->content }}</textarea></dd>
            </dl>
            <button type="submit">登録する</button>
        </form>
        <a href="{{ route('memos.show', $memo->id) }}">キャンセル</a>
    </body>
</html>