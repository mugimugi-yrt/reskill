@extends('commons.hotel_form')

@section('title')
宿情報編集 - {{ $hotel->name }}
@endsection

@section('sending_form')
<form action="{{ route('admin.hotels.edit.check', $hotel->id) }}" method="post" enctype="multipart/form-data">
@endsection

@section('back_link')
<a href="{{ route('admin.hotels.show', $hotel->id) }}">{{ $hotel->name }}の詳細画面に戻る</a>
@endsection