@extends('layouts.app')
<!-- $hotels という変数の中に hotelテーブルすべてのオブジェクトが入ってます -->

@section('title')
プラン情報詳細 - {{ $plan->name }}
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@endsection

@section('content')
<h2>プラン情報詳細 - {{ $plan->name }}</h2>
<div class="details">
    <img src="{{ asset($plan->hotel->image) }}" alt="{{ $plan->hotel->name }}" id="plan_photo">
</div>
@if (Auth::user()->is_admin && !$plan->is_deleted && !$plan->hotel->is_deleted)
    <div id="action-buttons">
        <a href="{{ route('admin.plans.edit', $plan->id) }}" id="edit">編集する</a>
        <a href="#" id="delete" onclick="deletePlan()">削除する</a>
    </div>

    <form action="{{ route('admin.plans.destroy', $plan->id) }}" method="post" id="delete-form">
        @csrf
        @method('delete')
    </form>
    <script type="text/javascript">
        function deletePlan() {
            event.preventDefault();
            if (window.confirm('本当に削除しますか？')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
@endif
<div class='details'>
    <div class="detail-item">
        <label>予約数</label>
        <p>{{ $plan->reservations->count() }} 件</p>
    </div>
    <div class="detail-item">
        <label>プラン名</label>
        <p>{{ $plan->name }}</p>
    </div>
    <div class="detail-item">
        <label>ホテル名</label>
        <p>
            @if (Auth::user()->is_admin)
                <a href="{{ route('admin.hotels.show', $plan->hotel->id) }}">{{ $plan->hotel->name }}</a>
            @else
                <a href="{{ route('searches.hotels.show', $plan->hotel->id) }}">{{ $plan->hotel->name }}</a>
            @endif
        </p>
    </div>
    <div class="detail-item">
        <label>料金</label>
        <p>{{ $plan->price }} 円</p>
    </div>
    <div class="detail-item">
        <label>最大利用可能人数</label>
        <p>{{ $plan->max_guest }} 人</p>
    </div>
    <div class="detail-item">
        <label>食事</label>
        <p>{{ $plan->meal ? 'あり' : 'なし' }}</p>
    </div>
    <div class="detail-item">
        <label>プラン予約可能期間</label>
        <p>{{ $plan->start_date }} ～ {{ $plan->end_date }}</p>
    </div>
    <div class="detail-item">
        <label>プラン説明</label>
        <p>{{ $plan->description }}</p>
    </div>
</div>
@if (Auth::user()->is_admin)
    <p id="back">
        <a href="{{ route('admin.plans.index') }}">プラン一覧に戻る</a>
    </p>
@elseif (!Auth::user()->is_admin && !$plan->is_deleted && !$plan->hotel->is_deleted)
    <form action="{{ route('admin.reservations.create', $plan->id) }}" method="post">
        @csrf
        <button type="submit">予約する</button>
    </form>
@endif
@endsection