@extends('layouts.app')

@section('content')
<h1>マイページ</h1>
<p>
    ようこそ、{{ \Auth::user()->name }}さん<br>
    <a href="{{ route('edit', \Auth::id()) }}">プロフィール編集画面へ</a>
</p>

<form action="{{ route('messages.store') }}" method="post">
    @csrf
    <textarea name="content" row="5" placeholder="メッセージを入力"></textarea><br>
    <input type="submit" value="投稿する">
</form>

@include('commons.messages')

<form action="{{ route('destroy') }}" method="POST">
    @csrf
    @method('delete')
    <input type="submit" value="退会する">
</form>
@endsection