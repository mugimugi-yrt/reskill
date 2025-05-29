<table>
    <tr>
        <th>詳細</th>
        <th>注文ID</th>
        <th>注文日</th>
        <th>顧客名</th>
        <th>商品名</th>
        <th>注文数</th>
        <th>注文合計金額</th>
        <th>発送日</th>
    </tr>
    @foreach ($orders as $order)
        <tr>
            <td><a href="{{ route('orders.show', $order) }}">詳細</a></td>
            <td>{{ $order->id }}</td>
            <td>{{ $order->created_at->format('Y年m月d日') }}</td>
            <td>{{ $order->customer->name }}</td>
            <td>{{ $order->product->name }}</td>
            <td>{{ $order->quantity }}</td>
            <td>{{ $order->unit_price * $order->quantity }}円</td>
            <td>
                @if($order->shipped_on)
                    {{ $order->shipped_on }}
                @else
                    <form action="{{ route('orders.ship', $order) }}" method="post" id="done-ship">
                        @csrf
                        @method('patch')
                        <button type="submit" onclick="doneShip()">発送済みにする</button>
                    </form>
                    <script type="text/javascript">
                        function doneShip() {
                            event.preventDefault();
                            if (window.confirm('発送済みにしますか？')) {
                                document.getElementById('done-ship').submit();
                            }
                        }
                    </script>
                @endif
            </td>
        </tr>
    @endforeach
</table>