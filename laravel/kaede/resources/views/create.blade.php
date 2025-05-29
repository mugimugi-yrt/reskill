<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>kaede アプリ</title>
    </head>
    <body>
        <h1>書籍の新規作成</h1>
        <form action="{{ route('books.store') }}" method="post">
            @csrf
            <dl>
                <dt>タイトル</dt>
                <dd><input type="text" name="title"></dd>
                <dt>著者</dt>
                <dd><input type="text" name="author"></dd>
                <dt>出版日</dt>
                <dd><input type="date" name="published_on"></dd>
            </dl>
            <button type="submit">登録する</button>
        </form>
        <a href="/">戻る</a>
    </body>
</html>