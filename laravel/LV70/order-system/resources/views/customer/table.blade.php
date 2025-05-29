<table>
    <tr>
        <th>顧客ID</th>
        <th>顧客名</th>
    </tr>
    @foreach ($customers as $customer)
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
        </tr>
    @endforeach
</table>