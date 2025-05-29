<table class="table">
    <thread>
        <tr>
            <th>投稿者</th>
            <th>タイトル</th>
            <th>著者</th>
            <th>出版社</th>
        </tr>
    </tread>
    <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{ $book->user->name }}</td>
                <td>
                    <a href="{{ route('books.show', $book->id) }}">
                        {{ $book->title }}
                    </a>
                </td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->publisher }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $books->links() }}