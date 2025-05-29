
<!-- $hotels という変数の中に hotelテーブルすべてのオブジェクトが入ってます -->
@extends('layouts.app')
@section('title')
プラン情報詳細 - {{ $plan->name }}
@endsection
@section('css')
        <link rel="stylesheet" href="/css/admin.css">
    @endsection
    
@section('content')
<h2>プラン情報詳細 - {{ $plan->name }}</h2>
<div class="details">
<div>
    <img src="/img/{{ $plan->hotel->image }}" alt="{{ $plan->hotel->name }}" id="plan_photo" width="200">
</div>
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
    <class="detail-item">
        予約数：
        <span>{{ $plan->reservations->count() }} 件</span>
    </div>
    <div class="detail-item">
        プラン名：
        <span>{{ $plan->name }}</span>
    </div>
    <div class="detail-item">
        ホテル名：
        <span>
            @if (Auth::user()->is_admin)
                <a href="{{ route('admin.hotels.show', $plan->hotel->id) }}">{{ $plan->hotel->name }}</a>
            @else
                <a href="{{ route('searches.hotels.show', $plan->hotel->id) }}">{{ $plan->hotel->name }}</a>
            @endif
        </div>
    </div>
    <div class="detail-item">
        料金：
        <span>{{ $plan->price }} 円</span>
    </div>
    <div class="detail-item">
        最大利用可能人数：
        <span>{{ $plan->max_guest }} 人</span>
    </div>
    <div class="detail-item">
        食事：
        <span>{{ $plan->meal ? 'あり' : 'なし' }}</span>
    </div>
    <div class="detail-item">
        プラン予約可能期間：
        <span>{{ $plan->start_date }} ～ {{ $plan->end_date }}</span>
    </div>
    <div class="detail-item">
        プラン説明：
        <span>{{ $plan->description }}</span>
    </div>
</div>
@if (Auth::user()->is_admin)
    <div id="back">
        <a href="{{ route('admin.plans.index') }}">プラン一覧に戻る</a>
    </div>
@elseif (!Auth::user()->is_admin && !$plan->is_deleted && !$plan->hotel->is_deleted)
     <form action="{{ route("reservations.create") }}" method="post">
            @csrf
            <input type="hidden" name="plan" value="{{ $plan }}">
            <button type="submit">予約する</button>
        </form>
@endif

@endsection