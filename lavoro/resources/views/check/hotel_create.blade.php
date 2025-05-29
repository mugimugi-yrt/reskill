@extends('commons.hotel_check')

@section('title')
[確認] 新規宿作成
@endsection

@section('sending_form')
<form action="{{ route('admin.hotels.store') }}" method="post">
@endsection

@section('send_button')
<button type="submit" id="submit_create" onclick="goToShow()">登録する</button>

<script type="text/javascript">
    function goToShow() {
        alert("{{ $formData['name'] }}の宿情報を新しく作成しました。");
        document.querySelector('form').submit();
    }
</script>
@endsection

@section('back_link')
<a href="{{ route('admin.hotels.create') }}">作成画面に戻る</a>
@endsection