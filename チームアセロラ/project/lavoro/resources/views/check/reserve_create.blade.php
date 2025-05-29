@extends('layouts.app')

@section('title')
予約情報入力 - 確認画面
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@endsection
@section('content')

<h2>予約情報入力 - 確認画面</h2>
<p>
    <label>チェックイン日時</label>
    {{ str_replace("T"," ",$validateData['check_in']) }}
</p>
<p>
    <label>チェックアウト日時</label>
    {{ str_replace("T"," ",$validateData['check_out']) }}
</p>
<p>
    <label>利用人数</label>
    {{ $validateData['num_user'] }}
</p>
<p>
    <button type="button" onclick="goToIndex()">予約を確定する</button>
</p>

<script type="text/javascript">
    function goToIndex(validateData) {
        alert('予約を確定しました。');
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('reservations.store') }}";

        const csrfToken = "{{ csrf_token() }}";
        const tokenInput = document.createElement("input");
        tokenInput.type = "hidden";
        tokenInput.name = "_token";
        tokenInput.value = csrfToken;
        form.appendChild(tokenInput);

        const methodInput = document.createElement('input');

        methodInput.type = 'hidden';
        methodInput.name = '__method'
        methodInput.value = 'PUT';
        form.appendChild(methodInput);
        const dataInput = document.createElement('input');

        dataInput.type = 'hidden';
        dataInput.name = 'validateData'
        dataInput.value = JSON.stringify(@json($validateData));
        form.appendChild(dataInput);

        document.body.appendChild(form);
        form.submit();
    }
</script>  
@endsection