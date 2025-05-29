@extends('layout')

@section('content')
<header>
    @include('search')
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
    @include('table')
</main>
@endsection