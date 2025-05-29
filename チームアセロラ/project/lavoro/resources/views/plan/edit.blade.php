@extends('commons.plan_form')

@section('title')
プラン情報編集 - {{ $plan->name }}
@endsection

@section('sending_form')
<form action="{{ route('admin.plans.edit.check', $plan->id) }}" method="post">
@endsection

@section('back_link')
<a href="{{ route('admin.plans.show', $plan->id) }}">{{ $plan->name }}の詳細画面に戻る</a>
@endsection