<table border="1">
    <tr>
        <th></th>
        <th>ID</th>
        <th>商品名</th>
        <th>分類</th>
        <th>価格</th>
    </tr>
    @foreach ($items as $item)
        <tr>
            <!-- 商品詳細ページへのリンクが各行に設置されている (問題 4) -->
            <td><a href="{{ route('items.show', $item) }}">詳細</a></td>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->category->name }}</td>
            <td>{{ $item->price }}円</td>
        </tr>
    @endforeach
</table>