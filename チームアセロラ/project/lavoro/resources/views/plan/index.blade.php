@extends('layouts.app')
<!-- $hotels という変数の中に hotelテーブルすべてのオブジェクトが入ってます -->

@section('title')
プラン一覧
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@endsection

@section('content')
<h2>プラン一覧</h2>
<div> <!-- ページ内リンク-->
    <p id='create'><a href="{{ route('admin.plans.create') }}">＋プラン新規登録</a></p>
</div>
<table id='index_table'>
    <thead>
        <tr>
            <th>ID</th>
            <th>プラン名</th>
            <th>ホテル名</th>
            <th>料金</th>
            <th>削除済み</th>
        </tr>
    </thead>
    <tbody>
        @foreach($plans as $plan)
            <tr>
                <td>{{ $plan->id }}</td>
                <td class='show'><a href="{{ route('admin.plans.show', $plan->id) }}">{{ $plan->name }}</a></td>
                <td>{{ $plan->hotel->name }}</td>
                <td>{{ $plan->price }}円</td>
                <td>@if($plan->is_deleted) 〇 @endif</td>
            </tr>
        @endforeach
</tbody>
</table>
@endsection