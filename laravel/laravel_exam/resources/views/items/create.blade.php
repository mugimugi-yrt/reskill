<!-- 問題 5 : 商品新規登録機能 -->
@extends('template.layout')

<!-- title要素とページタイトル -->
@section('title')

商品新規作成

@endsection

<!-- htmlの中身 -->
<!-- 商品情報を入力して送信ボタンを押すと、商品が正常に登録される (問題 5) -->
@section('content')

<form action="{{ route('items.store') }}" method="post">
    @include('commons.form') <!-- 新規作成・編集用フォーム (問題 5 / 問題 7) -->
    <button type="submit">登録する</button> <!-- 送信ボタン (問題 5) -->
</form>
<hr>
<!-- 商品一覧画面に遷移する「戻る」のリンクが設置されている (問題 5) -->
<a href="{{ route('items.index') }}">戻る</a>

@endsection