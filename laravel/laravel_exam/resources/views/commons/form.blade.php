@csrf
<dl>
    <dt>商品名</dt>
        <dd>
            <!-- 商品名入力用テキストフィールド (問題 5) -->
            <!-- 名前、値段が空欄だと「このフィールドを入力してください」という表示が出る (問題 5) -->
            <input type="text" name="name" value="{{ old('name', $item->name) }}" required>
        </dd>
    <dt>分類</dt>
        <dd>
            <!-- 分類選択用のセレクトボックス  (問題 5) -->
            <select name="category_id" required>
                <option value="" @selected($item->category_id == "")>カテゴリを選択</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($item->category_id == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </dd>
    <dt>価格</dt>
        <dd>
            <!-- 値段入力用テキストフィールド (問題 5) -->
            <!-- 名前、値段が空欄だと「このフィールドを入力してください」という表示が出る (問題 5) -->
            <!-- 値段は数字以外入力できない (問題 5) -->
            <input type="number" name="price" value="{{ old('price', $item->price) }}" required> 円
        </dd>
</dl>