<!-- $formData に validateされたデータが入っている -->

@extends('commons.user_check')

@section('title')
[確認] ユーザー情報変更- {{ $formData['last_name'] . ' ' . $formData['first_name'] }}
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@endsection

@section('sending_form')
<form action="{{ route('admin.users.update', $user_id) }}" method="post">
@method('patch')
@endsection

@section('send_button')
<button type="submit" id="submit_edit" onclick="goToShow()">変更する</button>

<script type="text/javascript">
    function goToShow() {
        alert("{{ $formData['last_name'] . ' ' . $formData['first_name'] }}のユーザー情報を更新しました。");
        document.getElementById('edit_form').submit();
    }
</script>
@endsection

@section('back_link')
<a href="{{ route('admin.users.edit', $user_id) }}">変更画面に戻る</a>
@endsection