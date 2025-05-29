@extends('layouts.app')

@section('title')
@yield('title')
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@endsection

@section('content')
<h2>@yield('title')</h2>
@include('commons.flash')
@yield('sending_form')
    @csrf
    <div class='details'>
        <div class="detail-item">
            <label>プラン名</label>
            <input type="hidden" name="name" value="{{ $formData['name'] }}">{{ $formData['name'] }}
        </div>
        <div class="detail-item">
            <label>ホテル名</label>
            <input type="hidden" name="hotel_id" value="{{ $formData['hotel_id'] }}">{{ $hotelName }}
        </div>
        <div class="detail-item">
            <label>料金</label>
            <input type="hidden" name="price" value="{{ $formData['price'] }}">{{ number_format($formData['price']) }} 円
        </div>
        <div class="detail-item">
            <label>最大利用可能人数</label>
            <input type="hidden" name="max_guest" value="{{ $formData['max_guest'] }}">{{ $formData['max_guest'] }} 人
        </div>
        <div class="detail-item">
            <label>食事</label>
            <input type="hidden" name="meal" value="{{ $formData['meal'] }}">
            @if ($formData['meal'])
                あり
            @else
                なし
            @endif
        </div>
        <div class="detail-item">
            <label>プラン予約可能期間</label>
            開始日: <input type="hidden" name="start_date" value="{{ $formData['start_date'] }}">{{ $formData['start_date'] }}<br>
            終了日: <input type="hidden" name="end_date" value="{{ $formData['end_date'] }}">{{ $formData['end_date'] }}
        </div>
        <div class="detail-item">
            <label>プラン説明</label>
            <input type="hidden" name="description" value="{{ $formData['description'] }}">
            {!! nl2br(e($formData['description'])) !!}
        </div>
        @yield('send_button')
    </div>
</form>
<p id="back">
    @yield('back_link')
</p>
@endsection
