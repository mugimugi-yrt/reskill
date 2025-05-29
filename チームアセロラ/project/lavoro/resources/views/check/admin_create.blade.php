<!-- $formData に validateされたデータが入っている -->

@extends('commons.user_check')

@section('title')
[確認] 新規ユーザー作成
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@endsection

@section('sending_form')
<form action="{{ route('admin.users.store') }}" method="post">
@endsection

@section('send_button')
<button type="submit" id="submit_create" onclick="goToShow()">登録する</button>

<script type="text/javascript">
    function goToShow() {
        alert("{{ $formData['last_name'] . ' ' . $formData['first_name'] }}のユーザー情報を新しく作成しました。");
        document.querySelector('form').submit();
    }
</script>
@endsection

@section('back_link')
<a href="{{ route('admin.users.create') }}">作成画面に戻る</a>
@endsection