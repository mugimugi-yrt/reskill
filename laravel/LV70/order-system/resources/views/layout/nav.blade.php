<!-- if (Auth::check()) -->
    <ul class="navigation">
        <li>
            <a href="{{ route('product.index') }}">商品管理</a>
        </li>
        <li>
            <a href="{{ route('customers.index') }}">顧客管理</a>
        </li>
        <li>
            <a href="{{ route('orders.index') }}">注文管理</a>
        </li>
    </ul>
<!-- endif -->