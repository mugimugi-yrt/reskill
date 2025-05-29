<table>
    <tr>
        <th>ID</th>
        <th>商品名</th>
        <th>カテゴリ</th>
        <th>価格</th>
    </tr>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->price }}円</td>
        </tr>
    @endforeach
</table>
{{ $products->appends(Request::all())->links() }}