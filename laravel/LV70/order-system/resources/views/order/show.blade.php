@extends('layout.app')

@section('content')
<div class="title">注文詳細</div>
<main>
    <table>
        <tr>
            <th>注文ID</th>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <th>顧客</th>
            <td>{{ $order->customer_id }} : {{ $order->customer->name }} 様</td>
        </tr>
        <tr>
            <th>商品</th>
            <td>{{ $order->product_id }} : {{ $order->product->name }} ({{ $order->product->category->name }})</td>
        </tr>
        <tr>
            <th>注文数</th>
            <td>{{ $order->quantity }} 個</td>
        </tr>
        <tr>
            <th>購入単価</th>
            <td>{{ $order->unit_price }} 円</td>
        </tr>
            <th>注文合計金額</th>
            <td>{{ $order->unit_price * $order->quantity }} 円</td>
        <tr>
            <th>注文日</th>
            <td>{{ $order->created_at->format('Y-m-d') }}</td>
        </tr>
            <th>発送日</th>
            @if($order->shipped_on)
                <td>{{ $order->shipped_on }}</td>
            @else
                <td>未発送</td>
            @endif
    </table>
    <p><a href="{{ route('orders.edit', $order) }}">編集</a></p>
    <form action="{{ route('orders.destroy', $order) }}" method="post" id="delete-order">
        @csrf
        @method('delete')
        <button type="submit" onclick="deleteOrder()">削除</button>
    </form>
    <script type="text/javascript">
        function deleteOrder() {
            event.preventDefault();
            if (window.confirm('本当に削除しますか？')) {
                document.getElementById('delete-order').submit();
            }
        }
    </script>
</main>
@endsection