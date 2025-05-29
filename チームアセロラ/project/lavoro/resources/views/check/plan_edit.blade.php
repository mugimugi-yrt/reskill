@extends('commons.plan_check')

@section('title')
[確認] プラン情報編集 - {{ $formData['name'] }}
@endsection

@section('sending_form')
<form action="{{ route('admin.plans.update', $plan_id) }}" method="post">
@method('patch')
@endsection

@section('send_button')
<button type="submit" id="submit_edit" onclick="goToShow()">変更する</button>

<script type="text/javascript">
    function goToShow() {
        alert("{{ $formData['name'] }}のプラン情報を更新しました。");
        document.getElementById('edit_form').submit();
    }
</script>
@endsection

@section('back_link')
<a href="{{ route('admin.plans.edit', $plan_id) }}">変更画面に戻る</a>
@endsection