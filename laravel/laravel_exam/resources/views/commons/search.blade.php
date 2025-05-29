<form action="/" method="get">
    <p>カテゴリー
        <select name="category_id">
            <option value="" @selected(request('category_id') == "")>カテゴリを選択</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </p>
    <p>商品名
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名">
    </p>
    <p>価格
        <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="円">
        ~
        <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="円">
    </p>
    <p>並び替え
        <select name="sort">
            <option value="" @selected(request('sort') == "")>新しい順</option>
            <option value="price_asc" @selected(request('sort') == "price_asc")>値段の安い順</option>
            <option value="price_desc" @selected(request('sort') == "price_desc")>値段の高い順</option>
        </select>
    </p>
    <button type="submit">検索</button>
</form>