@extends('commons.plan_form')

@section('title')
新規プラン作成
@endsection

@section('sending_form')
<form action="{{ route('admin.plans.create.check') }}" method="post">
@endsection

@section('back_link')
<a href="{{ route('admin.plans.index') }}">一覧画面に戻る</a>
@endsection