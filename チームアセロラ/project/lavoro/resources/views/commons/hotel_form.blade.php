@extends('layouts.app')
<!-- 宿のCREATE・EDIT用フォーム -->

@php
$address_parts = array_map('trim', explode(',', $hotel->address));
$address_post = $address_parts[0] ?? '';
$address_pref = $address_parts[1] ?? '';
$address_town = $address_parts[2] ?? '';
$address_street = $address_parts[3] ?? '';
$address_num = $address_parts[4] ?? '';
@endphp

@section('title')
@yield('title')
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@endsection

@section('content')
<h2>@yield('title')</h2>
@include('commons.flash')
<!-- formタグに enctype=”multipart/form-data” を入れる -->
@yield('sending_form')
    <div class='details'>
        @csrf
        <div class="detail-item">
            <label>ホテル名</label>
            <input type="text" name="name" value="{{ old('name', $hotel->name) }}">
        </div>
        <div class="detail-item">
            <label>住所</label>
            <table>
                <tr>
                    <td>郵便番号：</td>
                    <td>〒<input type="text" name="address_post" id="post" placeholder="000-0000" value="{{ old('address_post', $address_post) }}"><span class="caution">※1</span></td>
                </tr>
                <tr>
                    <td>都道府県：</td>
                    <td>
                        <select name="address_pref" id="pref">
                            <option value="" @selected($address_pref == '')>選択してください</option>
                                @php
                                $prefectures = [
                                    "北海道", "青森県", "岩手県", "宮城県", "秋田県", "山形県", "福島県",
                                    "茨城県", "栃木県", "群馬県", "埼玉県", "千葉県", "東京都", "神奈川県",
                                    "新潟県", "富山県", "石川県", "福井県", "山梨県", "長野県",
                                    "岐阜県", "静岡県", "愛知県", "三重県",
                                    "滋賀県", "京都府", "大阪府", "兵庫県", "奈良県", "和歌山県",
                                    "鳥取県", "島根県", "岡山県", "広島県", "山口県",
                                    "徳島県", "香川県", "愛媛県", "高知県",
                                    "福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"
                                ];
                                @endphp
                                @foreach ($prefectures as $pref)
                                    <option value="{{ $pref }}" @selected($pref === $address_pref)>{{ $pref }}</option>
                                @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>市区町村：</td>
                    <td><input type="text" name="address_town" id="town" placeholder="新宿区四谷" value="{{ old('address_town', $address_town) }}">            
                </tr>
                <tr>
                    <td>丁目番地号：</td>
                    <td><input type="text" name="address_street" id="street" placeholder="４－２８－４"value="{{ old('address_street', $address_street) }}"><span class="caution">※2</span></td>
                </tr>
                <tr>
                    <td>ﾏﾝｼｮﾝ名・部屋番号等：</td>
                    <td><input type="text" name="address_num" id="add_num" placeholder="ＹＫＢエンサインビル 10F"value="{{ old('address_num', $address_num) }}"></td>
                </tr>
            </table>
            <p class="caution">
                ※1 郵便番号は半角数字（ハイフンを含む）<br>
                ※2 丁目番地号はすべて全角（ハイフンを含む）
            </p>
        </div>
        <div class="detail-item">
            <label>最寄り駅</label>
            <input type="text" name="station" placeholder="例) 東京メトロ丸ノ内線新宿御苑前駅" value="{{ old('station', $hotel->station) }}">
        </div>
        <div class="detail-item">
            <label>電話番号</label>
            <input type="text" name="tel" placeholder="05055302815" value="{{ old('tel', $hotel->tel) }}">
            <p class="caution">※ハイフンを入れない</p>
        </div>
        <div class="detail-item">
            <label>イメージ</label>
            <input type="file" name="img_source" accept="image/jpeg,image/png,image/jpg">
            @if ($hotel->image)
                <!-- edit用の画像確認フィールド -->
                <br>
                <span>現在の画像:</span><br>
                    <img src="{{ asset($hotel->image) }}" alt="現在の画像" width="150">
            @endif
        </div>
        <div class="detail-item">
            <label>営業時間:</label>
            <input type="time" name="start_time" value="{{ old('start_time', $hotel->start_time) }}">
            ~
            <input type="time" name="end_time" value="{{ old('end_time', $hotel->end_time) }}">
        </div>
        <div class="detail-item">
            <label>温泉の有無</label>
            <input type="radio" name="hot_spring" value="" @checked(old('hot_spring', $hotel->hot_spring) === null)>わからない
            <input type="radio" name="hot_spring" value="1" @checked(old('hot_spring', $hotel->hot_spring) == '1')>あり
            <input type="radio" name="hot_spring" value="0" @checked(old('hot_spring', $hotel->hot_spring) == '0')>なし
        </div>
        <div class="detail-item">
            <label>ホテルのジャンル</label>
                <select name="genre">
                    <option value="" @selected($hotel->genre == '')>ジャンルなし</option>
                    <option value="ビジネスホテル" @selected($hotel->genre === 'ビジネスホテル')>ビジネスホテル</option>
                    <option value="シティホテル" @selected($hotel->genre === 'シティホテル')>シティホテル</option>
                    <option value="カプセルホテル" @selected($hotel->genre === 'カプセルホテル')>カプセルホテル</option>
            </select>
        </div>
        <div class="detail-item">
            <label>団体受け入れ可能客室数</label>
            <input type="num" name="group_room" value="{{ old('group_room, $hotel->group_room') }}">部屋
        </div>
        <button type="submit" id="submit_check">確認画面へ</button>
    </div>
</form>
<p id="back">
    @yield('back_link')
</p>
@endsection