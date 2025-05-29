@extends('layout.app')

@section('content')
<div class="title">注文管理</div>
<main>
    <p><a href="{{ route('orders.create') }}">新規注文作成</a></p>
    @include('order.table')
</main>
@endsection