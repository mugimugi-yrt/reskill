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
            <label>ホテル名</label>
            <input type="hidden" name="name" value="{{ $formData['name'] }}">{{ $formData['name'] }}
        </div>
        <div class="detail-item">
            <label>住所</label>
            <table>
                <tr>
                    <td>郵便番号：</td>
                    <td>〒<input type="hidden" name="address_post" value="{{ $formData['address_post'] }}">{{ $formData['address_post'] }}</td>
                </tr>
                <tr>
                    <td>都道府県：</td>
                    <td><input type="hidden" name="address_pref" value="{{ $formData['address_pref'] }}">{{ $formData['address_pref'] }}</td>
                </tr>
                <tr>
                    <td>市区町村：</td>
                    <td><input type="hidden" name="address_town" value="{{ $formData['address_town'] }}">{{ $formData['address_town'] }}</td>
                </tr>
                <tr>
                    <td>丁目番地号：</td>
                    <td><input type="hidden" name="address_street" value="{{ $formData['address_street'] }}">{{ $formData['address_street'] }}</td>
                </tr>
                <tr>
                    <td>ﾏﾝｼｮﾝ名・部屋番号等：</td>
                    <td><input type="hidden" name="address_num" value="{{ $formData['address_num'] }}">{{ $formData['address_num'] }}</td>
                <tr>
            </table>
        </div>
        <div class="detail-item">
            <label>最寄り駅</label>
            <input type="hidden" name="station" value="{{ $formData['station'] }}">{{ $formData['station'] }}
        </div>
        <div class="detail-item">
            <label>電話番号</label>
            <input type="hidden" name="tel" value="{{ $formData['tel'] }}">{{ $formData['tel'] }}
        </div>
        <div class="detail-item">
            <label>イメージ</label>
            <input type="hidden" name="image" value="{{ $formData['image'] }}">
            <img src="{{ asset($formData['image']) }}" alt="プレビュー" width="300">
        </div>
        <div class="detail-item">
            <label>営業時間</label>
            <input type="hidden" name="start_time" value="{{ $formData['start_time'] }}">{{ $formData['start_time'] }}
            ~
            <input type="hidden" name="end_time" value="{{ $formData['end_time'] }}">{{ $formData['end_time'] }}
        </div>
        <div class="detail-item">
            <label>温泉の有無</label>
            <input type="hidden" name="hot_spring" value="{{ $formData['hot_spring'] }}">
            @if ($formData['hot_spring'] === null)
                わからない
            @elseif ($formData['hot_spring'])
                あり
            @else
                なし
            @endif
        </div>
        <div class="detail-item">
            <label>ホテルのジャンル</label>
            <input type="hidden" name="genre" value="{{ $formData['genre'] }}">{{ $formData['genre'] }}
        </div>
        <div class="detail-item">
            <label>団体受け入れ可能客室数</label>
            @if ($formData['group_room'])
                <input type="hidden" name="group_room" value="{{ $formData['group_room'] }}">{{ $formData['group_room'] }}部屋
            @else
                <input type="hidden" name="group_room" value="">入力なし
            @endif
        </div>
        @yield('send_button')
    </div>
</form>
<p id="back">
    @yield('back_link')
</p>
@endsection