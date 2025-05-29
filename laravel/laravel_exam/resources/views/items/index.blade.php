<!-- 問題 4 : 商品一覧表示機能 -->
@extends('template.layout')

<!-- title要素とページタイトル -->
@section('title')

商品一覧

@endsection

<!-- htmlの中身 -->
@section('content')

<!-- 新規作成ページへのリンクが設置されている (問題 4) -->
<p><a href="{{ route('items.create') }}">＋新規作成</a></p>
@include('commons.search')  <!-- 検索表示 (問題 8) -->
<br>
@include('commons.items')  <!-- 商品テーブル (問題 4) -->

@endsection