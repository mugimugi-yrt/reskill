@extends('layout.app')

@section('content')
<div class="title">注文登録</div>
<main>
    @include('layout.flash')
    <form action="{{ route('orders.store') }}" method="post">
        @csrf
        <dl>
            <dt>顧客名</dt>
                <dd>
                    <select name="customer_id">
                        <option value="">-- 選択 --</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }} 様</option>
                        @endforeach
                    </select>
                </dd>
            <dt>商品を選択</dt>
                <dd>
                    <select name="product_id">
                        <option value="">-- 選択 --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->category->name }})</option>
                        @endforeach
                    </select>
                </dd>
            <dt>注文数</dt>
                <dd>
                    <input type="number" name="quantity" value="{{ old('quantity') }}"> 個
                </dd>
        </dl>
        <button type="submit">登録する</button>
    </form>
</main>
@endsection