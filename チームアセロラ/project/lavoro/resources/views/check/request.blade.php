@extends('layouts.app')

@section('title')
新規管理者登録依頼 - 確認画面
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@endsection

@section('content')
<h2>[確認] 新規管理者登録依頼</h2>
<div class="details">
    <div class="detail-item">
        <label>メールアドレス</label>
        {{ $formData['email'] }}
    </div>
    <div class="detail-item">
        <label>パスワード</label>
        {{ str_repeat('●', strlen($formData['password'])) }}
    </div>
    <button type="button" onclick="goToIndex()" id="submit_request">登録を依頼する</button>
</div>

<script type="text/javascript">
    function goToIndex() {
        alert('登録を依頼しました。');
        window.location.href = "{{ route('admin.users.index') }}";
    }
</script>
@endsection