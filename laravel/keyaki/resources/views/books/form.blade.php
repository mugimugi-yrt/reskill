@csrf
<dl>
    <dt>タイトル (必須)</dt>
    <dd>
        <input type="text" name="title" value="{{ old('title', $book->title) }}">
    </dd>
    <dt>著者</dt>
    <dd>
        <input type="text" name="author" value="{{ old('author', $book->author) }}">
    </dd>
    <dt>出版社</dt>
    <dd>
        <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}">
    </dd>
    <dt>感想文</dt>
    <dd>
        <textarea name="review" row="5">
            {{ old('review', $book->review) }}
        </textarea>
    </dd>
</dl>