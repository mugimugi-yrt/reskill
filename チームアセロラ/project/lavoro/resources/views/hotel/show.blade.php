@extends('layouts.app')

@php
$address_parts = array_map('trim', explode(',', $hotel->address));
$address_post = $address_parts[0] ?? '';
$address_pref = $address_parts[1] ?? '';
$address_town = $address_parts[2] ?? '';
$address_street = $address_parts[3] ?? '';
$address_num = $address_parts[4] ?? '';

$cnt_likes = $hotel->likeUsers()->count();

if($hotel->cnt_star_users > 0) {
  $number = $hotel->sum_stars / $hotel->cnt_star_users;
  $avr_star = number_format($number, 1);
}
else { $avr_star = 0; }

$score = ($cnt_likes + 1) * ($hotel->sum_stars + 1) * ($hotel->cnt_contents + 1);

if($hotel->hot_spring)      { $hot_spring = "あり"; }
elseif(!$hotel->hot_spring) { $hot_spring = "なし"; }
else                        { $get_notice = "わからない"; }
@endphp

@section('title')
宿詳細 - {{ $hotel->name }}
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@endsection

@section('content')
<h2>宿情報詳細 - {{ $hotel->name }}</h2>
<div class="details">
    <table id="hotel_photo_review">
        <tr><td colspan="2" rowspan="4"><img src="{{ asset($hotel->image) }}" alt="{{ $hotel->name }}"></td>
        <th id="score">評価：{{ $score }}点</th></tr>
        <tr><td>お気に入り数：{{ $cnt_likes }}</td></tr>
        <tr><td>星平均：{{ $avr_star }}</td></tr>
        <tr><td>口コミ数：{{ $hotel->cnt_contents }}</td></tr>
    </table>
</div>
@if (Auth::user()->is_admin && !$hotel->is_deleted)
    <div id="action-buttons">
        <a href="{{ route('admin.hotels.edit', $hotel->id) }}" id="edit">編集する</a>
        <a href="#" id="delete" onclick="deleteHotel()">削除する</a>
    </div>

    <form action="{{ route('admin.hotels.destroy', $hotel->id) }}" method="post" id="delete-form">
        @csrf
        @method('delete')
    </form>
    <script type="text/javascript">
        function deleteHotel() {
            event.preventDefault();
            if (window.confirm('本当に削除しますか？')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
@endif
<div class='details'>
    <div class="detail-item">
        <label>宿ID</label>
        <p>{{ $hotel->id }}</p>
    </div>
    <div class="detail-item">
        <label>ホテル名</label>
        <p>{{ $hotel->name }}</p>
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
        <label>最寄り駅</label>
        <p>{{ $hotel->station }}</p>
    </div>
    <div class="detail-item">
        <label>電話番号</label>
        <p>{{ $hotel->tel }}</p>
    </div>
    <div class="detail-item">
        <label>営業時間</label>
        <p>{{ $hotel->start_time }} ~ {{ $hotel->end_time }}</p>
    </div>
    <div class="detail-item">
        <label>温泉の有無</label>
        <p>{{ $hot_spring }}</p>
    </div>
    <div class="detail-item">
        <label>ホテルのジャンル</label>
        <p>{{ $hotel->genre }}</p>
    </div>
    <div class="detail-item">
        <label>団体受け入れ可能客室数</label>
        <p>
            @if ($hotel->group_room)
                <input type="hidden" name="group_room" value="{{ $hotel->group_room }}">{{ $hotel->group_room }} 部屋
            @else
                <input type="hidden" name="group_room" value="">入力なし
            @endif
        </p>
    </div>
</div>
@if (Auth::user()->is_admin)
    <div id='reservation'>
        予約履歴
        <!-- プラン名/ホテル名/チェックイン日時/チェックアウト日時/利用人数 -->
    </div>
    <div id='reservation'>
        口コミ履歴
        <!-- （ホテル名）への口コミ/コメントした日/コメント内容 -->
    </div>
@endif
<p id='back'>
    <a href="{{ route('admin.hotels.index') }}">宿一覧に戻る</a><!-- 宿一覧画面へ戻る -->
</p>
@endsection
