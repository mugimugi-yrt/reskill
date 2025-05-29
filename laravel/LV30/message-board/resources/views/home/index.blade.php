@extends('layouts.app')

@section('content')
<h1>マイページ</h1>
<p>ようこそ、{{ $user->name }}さん</p>
<p><a href="{{ route('edit', $user->id) }}">プロフィール編集画面へ</a></p>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <input type="submit" value="ログアウト">
</form>
<form action="{{ route('destroy') }}" method="POST">
    @csrf
    @method('delete')
    <input type="submit" value="退会する">
</form>
@endsection