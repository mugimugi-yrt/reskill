@extends('layouts.app')

@section('content')
<h1>メッセージ編集</h1>

@include('commons.flash')
<form action="{{ route('messages.update', $message) }}" method="post">
    @csrf
    @method('patch')
    <textarea name="content" row="5" placeholder="メッセージを入力">
        {{ $message->content }}
    </textarea><br>
    <button type="submit">更新</button>
</form>

<form action="{{ route('messages.destroy', $message) }}" method="post" id="delete-form">
    @csrf
    @method('delete')
    <button type="submit" onclick="deleteContent()">削除</button>
</form>
<script type="text/javascript">
    function deleteContent() {
        event.preventDefault();
        if (window.confirm('本当に削除しますか？')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>

<a href="{{ route('home') }}">キャンセル</a>
@endsection