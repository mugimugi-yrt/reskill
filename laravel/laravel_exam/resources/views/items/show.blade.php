<!-- 問題 6 : 商品詳細表示機能 -->
@extends('template.layout')

<!-- title要素とページタイトル -->
@section('title')

商品詳細

@endsection

<!-- htmlの中身 -->
@section('content')

<h2>{{ $item->name }}</h2>

<!-- 商品1件に関する情報（ID・商品名・分類・値段）が表示されている (問題 6) -->
<p>ID：{{ $item->id }}</p>
<p>分類：{{ $item->category->name }}</p>
<p>価格：{{ $item->price }}</p>

<p>
    <!-- 編集画面に遷移するリンクが設置されている (問題 6) -->
    <a href="{{ route('items.edit', $item) }}">編集する</a>

    <!-- 商品一覧画面に遷移するリンクが設置されている (問題 6) -->
    <a href="{{ route('items.index') }}">戻る</a>
</p>
<hr>
<!-- 削除するリンクが設置されている (問題 6)-->
<a href="#" onclick="deleteItem()">削除する</a>
<form action="{{ route('items.destroy', $item) }}" method="post" id="delete-item">
    @csrf
    @method('delete')
</form>

<!-- 削除するリンクを押すと「本当に削除しますか？」という確認が出る (問題 6) -->
<script type="text/javascript">
    function deleteItem() {
        event.preventDefault();
        
        // 「キャンセル」を押すと、何もせず元の画面に戻る (問題 6)
        // 「OK」を押すと、商品が削除されインデックスページに飛ぶ (問題 6)
        if (window.confirm('本当に削除しますか？')) {
            document.getElementById('delete-item').submit();
        }
    }
</script>

@endsection