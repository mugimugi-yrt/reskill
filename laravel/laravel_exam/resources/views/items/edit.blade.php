<!-- 問題 7 : 商品情報編集機能 -->
@extends('template.layout')

<!-- title要素とページタイトル -->
@section('title')

商品情報の編集

@endsection

<!-- htmlの中身 -->
@section('content')

<form action="{{ route('items.update', $item) }}" method="post">
    @method('patch')
    @include('commons.form')  <!-- 新規作成・編集用フォーム (問題 5 / 問題 7) -->
    <button type="submit">更新する</button>  <!-- 送信ボタン (問題 7) -->
</form>
<hr>
<a href="{{ route('items.index') }}">戻る</a>

@endsection