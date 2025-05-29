@extends('layouts.app')

@section('content')
<h1>メッセージ編集</h1>

<form action="{{ route('messages.update', $message->id) }}" method="post">
    @csrf
    @method('patch')
    <textarea name="content" row="5" placeholder="メッセージを入力">
        {{ $message->content }}
    </textarea><br>
    <button type="submit">更新</button>
</form>

<a href="{{ route('home') }}">キャンセル</a>
@endsection