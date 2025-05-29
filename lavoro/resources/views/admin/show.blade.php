@extends('layouts.app')
<!-- $user の中に、詳細としてクリックされたユーザーの情報を保持 -->

@php
$address_parts = array_map('trim', explode(',', $user->address));
$address_post = $address_parts[0] ?? '';
$address_pref = $address_parts[1] ?? '';
$address_town = $address_parts[2] ?? '';
$address_street = $address_parts[3] ?? '';
$address_num = $address_parts[4] ?? '';

if($user->get_notice) { $get_notice = "受け取る"; }
else                  { $get_notice = "受け取らない"; }
@endphp

@section('title')
ユーザー情報詳細 - {{ $user->name }}
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@endsection

@section('content')
<h2>ユーザー情報詳細 - {{ $user->name }}</h2>
@if (!$user->is_deleted)
    <div id="action-buttons">
        <a href="{{ route('admin.users.edit', $user->id) }}" id="edit">編集する</a>
        <a href="#" id="delete" onclick="deleteUser()">削除する</a>
    </div>

    <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" id="delete-form">
        @csrf
        @method('delete')
    </form>
    <script type="text/javascript">
        function deleteUser() {
            event.preventDefault();
            if (window.confirm('本当に削除しますか？')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
@else
    <h3>退会済み</h3>
@endif
<div class='details'>
    <div class="detail-item">
        <label>ユーザーID</label>
        <p>{{ $user->id }}</p>
    </div>
    <div class="detail-item">
        <label>氏名</label>
        <p>{{ $user->name }}</p>
    </div>
    <div class="detail-item">
        <label>フリガナ</label>
        <p>{{ $user->ruby }}</p>
    </div>
    <div class="detail-item">
        <label>電話番号</label>
        <p>{{ $user->tel }}</p>
    </div>
    <div class="detail-item">
        <label>メールアドレス</label>
        <p>{{ $user->email }}</p>
    </div>
    <div class="detail-item">
        <label>会社名</label>
        <p>{{ $user->company }}</p>
    </div>
    <div class="detail-item">
        <label>生年月日</label>
        <p>{{ $user->birthday }}</p>
    </div>
    <div class="detail-item">
        <label>住所</label>
        <p>
            〒{{ $address_post }}<br>
            {{ $address_pref }}
            {{ $address_town }}
            {{ $address_street }}
            {{ $address_num }}
        </p>
    </div>
    <div class="detail-item">
        <label>性別</label>
        <p>{{ $user->gender }}</p>
    </div>
    <div class="detail-item">
        <label>お知らせ配信</label>
        <p>{{ $get_notice }}</p>
    </div>
</div>
<div id='reservation'>
    <label>予約履歴</label>
    <!-- プラン名/ホテル名/チェックイン日時/チェックアウト日時/利用人数 -->
</div>
<div id='review'>
    <label>口コミ履歴</label>
    <!-- （ホテル名）への口コミ/コメントした日/コメント内容 -->
</div>
<p id='back'>
    <a href="{{ route('admin.users.index') }}">ユーザー一覧に戻る</a><!-- ユーザー一覧画面へ戻る -->
</p>
@endsection