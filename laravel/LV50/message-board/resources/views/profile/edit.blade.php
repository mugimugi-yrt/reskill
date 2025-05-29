@extends('layouts.app')

@section('content')
<h1>会員名編集</h1>

@include('commons.flash')
<form action="{{ route('update'), $user->name }}" method="post">
    @csrf
    @method('patch')
    <p>
        <label>名前</label><br>
        <input type="text" name="name" value="{{ $user->name }}">
    </p>
    <p>
        <button type="submit">更新する</button>
    </p>
</form>

<a href="{{ route('home') }}">キャンセル</a>
@endsection