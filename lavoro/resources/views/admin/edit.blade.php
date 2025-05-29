@extends('commons.user_form')

@section('title')
ユーザー情報変更  - {{ $user->name }}
@endsection

@section('sending_form')
<form action="{{ route('admin.users.edit.check', $user->id) }}" method="post">
@endsection

@section('back_link')
<a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}の詳細画面に戻る</a>
@endsection