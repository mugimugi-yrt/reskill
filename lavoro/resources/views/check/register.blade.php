@extends('commons.user_check')

@section('title')
新規会員登録 - 確認画面
@endsection

@section('sending_form')
<form action="{{ route('register') }}" method="post">
@endsection

@section('send_button')
登録する
@endsection

@section('back_link')
<a href="{{ route('register') }}">戻る</a>
@endsection