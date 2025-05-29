@extends('layouts.app')

@section('title')
新規管理者登録依頼
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@endsection

@section('content')
<h2>新規管理者登録依頼</h2>
@include('commons.flash')
<form action="{{ route('admin.request.check') }}" method="post">
    @csrf
    <div class="details">
        <div class="detail-item">
            <label>メールアドレス</label>
            <input type="email" name="email"><br>   
        </div>
        <div class="detail-item">
            <label>パスワード</label>
            <input type="password" name="password"><br>
        </div>
        <p>
            <button type="submit" id="submit_check">確認画面へ</button>
        </p>
    </div>
</form>
@endsection