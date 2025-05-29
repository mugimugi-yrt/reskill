@extends('layouts.app')

@section('content')
<h1>メッセージ情報</h1>
<dl>
    <dt>投稿者</dt>
    <dd>{{ $message->user->name }}</dd>
    <dt>本文</dt>
    <dd>{!! nl2br(e($message->content)) !!}</dd>
    <dt>イイネ！した人</dt>
    <dd>
        <ul>
            @foreach ($message->getLikeUsersNameArray() as $likeUser)
                <li>{{ $likeUser }}</li>
            @endforeach
        </ul>
    </dd>
</dl>
@endsection