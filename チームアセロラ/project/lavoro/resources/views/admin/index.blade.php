@extends('layouts.app')
<!-- $users という変数の中に userテーブルすべてのオブジェクトが入ってます -->

@section('title')
ユーザー一覧
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@endsection

@section('content')
<h2>ユーザー一覧</h2>
<p id='create'><a href="{{ route('admin.users.create') }}">＋ユーザー新規登録</a></p>
<table id='index_table'>
    <thead>
        <tr>
            <th>ID</th>
            <th>氏名</th>
            <th>電話番号</th>
            <th>メールアドレス</th>
            <th>退会済み</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            @if(!$user->is_admin)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td class='show'><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a></td>
                    <td>{{ $user->tel }}</td>
                    <td>{{ $user->email }}</td>
                    <td>@if($user->is_deleted) 〇 @endif</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
@endsection