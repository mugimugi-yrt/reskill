@extends('layout.app')

@section('content')
<div class="title">商品管理</div>
<header>
    @include('home.search')
    @if ($searched)
    <br>
    <div id="ansField">
        最大：{{ $products->max('price') }}円 |
        最小：{{ $products->min('price') }}円 |
        平均：{{ $products->average('price') }}円 |
        合計：{{ $products->sum('price') }}円
    </div>
    @endif
</header>
<main>
    @include('home.table')
</main>
@endsection