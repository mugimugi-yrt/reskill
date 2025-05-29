@extends('commons.login')

@section('title')
ログイン画面
@endsection

@section('links')
<a href="{{ route('register') }}">新規会員登録はコチラ</a><br>
<a href="{{ route('admin.login') }}">管理者ログインはコチラ</a>
@endsection