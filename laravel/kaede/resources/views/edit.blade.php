<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>kaede アプリ</title>
    </head>
    <body>
        <h1>書籍情報の編集</h1>
        <form action="{{ route('books.update', $book->id) }}" method="post">
            @csrf
            @method('patch')
            <dl>
                <dt>タイトル</dt>
                <dd><input type="text" name="title" value="{{ $book->title }}"></dd>
                <dt>著者</dt>
                <dd><input type="text" name="author" value="{{ $book->author }}"></dd>
                <dt>出版日</dt>
                <dd><input type="date" name="published_on" value="{{ $book->published_on }}"></dd>
            </dl>
            <button type="submit">更新する</button>
        </form>
        <hr>
        <a href="/">戻る</a>
    </body>
</html>