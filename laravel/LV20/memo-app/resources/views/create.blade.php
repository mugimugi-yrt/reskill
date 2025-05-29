<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>メモ帳アプリ</title>
    </head>
    <body>
        <h1>メモの新規作成</h1>
        <form action="{{ route('memos.store') }}" method="post">
            @csrf
            <dl>
                <dt>タイトル</dt>
                <!-- HTMLで入力チェックをするなら required属性 -->
                <dd><input type="text" name="title" required></dd>
                <dt>本文</dt>
                <dd><textarea name="content" required></textarea></dd>
            </dl>
            <button type="submit">登録する</button>
        </form>
        <a href="/">キャンセル</a>
    </body>
</html>