@extends('layout.app')

@section('content')
<div class="title">注文登録</div>
<main>
    @include('layout.flash')
    <form action="{{ route('orders.update', $order) }}" method="post">
        @csrf
        @method('patch')
        <dl>
            <dt>顧客名</dt>
                <dd>
                    <select name="customer_id">
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" @selected($order->customer_id == $customer->id)>{{ $customer->name }} 様</option>
                        @endforeach
                    </select>
                </dd>
            <dt>商品を選択</dt>
                <dd>
                    <select name="product_id">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" @selected($order->product_id == $product->id)>{{ $product->name }} ({{ $product->category->name }})</option>
                        @endforeach
                    </select>
                </dd>
            <dt>注文数</dt>
                <dd>
                    <input type="number" name="quantity" value="{{ $order->quantity }}"> 個
                </dd>
            <dt>注文数</dt>
                <dd>
                    <input type="number" name="unit_price" value="{{ $order->unit_price }}"> 円
                </dd>
            <dt>発送日</dt>
                <dd>
                    <input type="date" name="shipped_on" value="{{ $order->shipped_on }}">
                </dd>
        </dl>
        <button type="submit">更新する</button> <a href="{{ route('orders.show', $order) }}">キャンセル</a>
    </form>
</main>
@endsection