@extends('commons.hotel_form')

@section('title')
新規宿作成
@endsection

@section('sending_form')
<form action="{{ route('admin.hotels.create.check') }}" method="post" enctype="multipart/form-data">
@endsection

@section('back_link')
<a href="{{ route('admin.hotels.index') }}">一覧画面に戻る</a>
@endsection