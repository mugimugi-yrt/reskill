@extends('layouts.app')
<!-- $hotels という変数の中に hotelテーブルすべてのオブジェクトが入ってます -->

@section('title')
宿一覧
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@endsection

@section('content')
<h2>宿一覧</h2>
<div> <!-- ページ内リンク-->
   <p id='create'><a href="{{ route('admin.hotels.create') }}">+宿新規登録</a></p>
</div>
@foreach($hotels as $hotel)
  <table class='index_table_hotel'>
    @php
    $address_parts = array_map('trim', explode(',', $hotel->address));
    $address_pref = $address_parts[1] ?? '';
    @endphp
    <tr><td colspan="2" rowspan="4" class='photo_space'><img src="{{ asset($hotel->image) }}" alt="{{ $hotel->name }}"></td>
    <td class='show'>ホテル名：<a href="{{ route('admin.hotels.show', $hotel->id) }}">{{ $hotel->name }}</a></td></tr>
    <tr><td>住所(県)：{{ $address_pref }}</td></tr>
    <tr><td>電話番号：{{ $hotel->tel }}</td></tr>
    <tr><td>削除済み：@if($hotel->is_deleted) 〇  @endif</td></tr>
  </table>
  <p></p>
@endforeach
@endsection
