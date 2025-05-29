<form action="/" method="get">
    <!-- @csrf -->
    <dl>
        <dt>カテゴリ</dt>
        <dd>
            <select name="category">
                <option value="" @selected(request('category') == "")>カテゴリを選択</option>
                <!-- version 9 から selected とかいうのができたらしい -->
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }} ({{ $category->products->count() }})</option>
                @endforeach
            </select>
        </dd>
        <dt>価格</dt>
            <dd>
                <input type="number" name="minPrice" value="{{ request('minPrice') }}" placeholder="円">
                ~
                <input type="number" name="maxPrice" value="{{ request('maxPrice') }}" placeholder="円">
            </dd>
        <dt>キーワード</dt>
            <dd><input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名"></dd>
    </dl>
    <button type="submit">検索</button>
</form>