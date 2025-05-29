@extends('commons.user_form')

@section('title')
新規ユーザー作成
@endsection

@section('sending_form')
<form action="{{ route('admin.users.create.check') }}" method="post">
@endsection

@section('back_link')
<a href="{{ route('admin.users.index') }}">一覧画面に戻る</a>
@endsection