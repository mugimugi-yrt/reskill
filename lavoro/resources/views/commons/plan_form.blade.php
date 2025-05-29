@extends('layouts.app')
<!-- プランのCREATE・EDIT用フォーム -->

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
    <div class='details'>
        @csrf
        <div class="detail-item">
            <label>プラン名</label>
            <input type="text" name="name" placeholder="例) ファミリープラン" value="{{ old('name', $plan->name) }}">
        </div>
        <div class="detail-item">
            <label>ホテル名</label>
            <select name="hotel_id">
                <option value="" @selected($plan->hotel_id == '')>選択してください</option>
                @foreach($hotels as $hotel)
                    @if (!$hotel->is_deleted)
                        <option value="{{ $hotel->id }}" @selected($plan->hotel_id == $hotel->id )>{{ $hotel->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="detail-item">
            <label>料金</label>
            <input type="number" name="price" placeholder="例) 12000" value="{{ old('price', $plan->price) }}"> 円
        </div>
        <div class="detail-item">
            <label>最大利用可能人数</label>
            <input type="number" name="max_guest" placeholder="例) 4"  value="{{ old('max_guest', $plan->max_guest) }}"> 人
        </div>
        <div class="detail-item">
            <label>食事</label>
            <input type="radio" name="meal" value="1" @checked(old('meal', $plan->meal) == '1')>あり
            <input type="radio" name="meal" value="0" @checked(old('meal', $plan->meal) == '0')>なし
        </div>
        <div class="detail-item">
            <label>プラン予約可能期間</label>
            <table>
                <tr>
                    <td>開始日：</td>
                    <td><input type="date" name="start_date" value="{{ old('start_date', $plan->start_date) }}"></td>
                </tr>
                <tr>
                    <td>終了日：</td>
                    <td><input type="date" name="end_date" value="{{ old('end_date', $plan->end_date) }}"></td>
                </tr>
            </table>
        </div>
        <div class="detail-item">
            <label>プラン説明</label>
            <textarea name="description" rows="5" cols="50" placeholder="プランの詳細を入力してください">{{ old('description', $plan->description) }}</textarea>
        </div>
        <button type="submit" id="submit_check">確認画面へ</button>
    </div>
</form>
<p id="back">
    @yield('back_link')
</p>
@endsection