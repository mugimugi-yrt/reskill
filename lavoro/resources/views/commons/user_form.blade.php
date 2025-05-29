@extends('layouts.app')
<!-- ユーザーのCREATE・EDIT用フォーム -->

@php
$name_parts = array_map('trim', explode(' ', $user->name));
$last_name = $name_parts[0] ?? '';
$first_name = $name_parts[1] ?? '';

$ruby_parts = array_map('trim', explode(' ', $user->ruby));
$last_ruby = $ruby_parts[0] ?? '';
$first_ruby = $ruby_parts[1] ?? '';

$address_parts = array_map('trim', explode(',', $user->address));
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
@yield('sending_form')
    <div class='details'>
        @csrf
        <div class="detail-item">
            <label>氏名</label>
            <input type="text" name="last_name" class="name" placeholder="例) 田中" value="{{ old('last_name', $last_name) }}">
            <input type="text" name="first_name" class="name" placeholder="例) 太郎" value="{{ old('first_name', $first_name) }}">
        </div>
        <div class="detail-item">
            <label>フリガナ</label>
            <input type="text" name="last_ruby" class="name" placeholder="例) タナカ" value="{{ old('last_ruby', $last_ruby) }}">
            <input type="text" name="first_ruby" class="name" placeholder="例) タロウ" value="{{ old('first_ruby', $first_ruby) }}">
        </div>
        <div class="detail-item">
            <label>パスワード</label>
            <input type="password" name="password">
        </div>
        <div class="detail-item">
            <label>パスワード（確認用）</label>
            <input type="password" name="password_confirmation">
        </div>
        <div class="detail-item">
            <label>メールアドレス</label>
            <input type="email" name="email" id="email" placeholder="例) tanaka@example.com" value="{{ old('email', $user->email) }}">
        </div>
        <div class="detail-item">
            <label>電話番号</label>
            <input type="text" name="tel" id="tel" placeholder="05055302815" value="{{ old('tel', $user->tel) }}">
            <p class="caution">※ハイフンを入れない</p>
        </div>
        <div class="detail-item">
            <label>会社名<label>
            <input type="text" name="company" id="company" placeholder="例) リスキル株式会社" value="{{ old('company', $user->company) }}">
        </div>
        <div class="detail-item">
            <label>生年月日</label>
            <input type="date" name="birthday" value="{{ old('birthday', $user->birthday) }}">
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
            <label>性別</label>
            <input type="radio" name="gender" value="回答しない" @checked(old('gender', $user->gender) == '' || old('gender', $user->gender) == '回答しない')>回答しない
            <input type="radio" name="gender" value="男" @checked(old('gender', $user->gender) == '男')>男
            <input type="radio" name="gender" value="女" @checked(old('gender', $user->gender) == '女')>女
        </div>
        <div class="detail-item">
            <label>お知らせ配信</label>
            <!-- 1 = true -->
            <input type="radio" name="get_notice" value="1"  @checked(old('get_notice', $user->get_notice) == '' || old('get_notice', $user->get_notice) == '1')>受け取る
            <!-- 0 = false -->
            <input type="radio" name="get_notice" value="0" @checked(old('get_notice', $user->get_notice) == '0')>受け取らない
        </div>
        <button type="submit" id="submit_check">確認画面へ</button>
    </div>
</form>
<p id="back">
    @yield('back_link')
</p>
@endsection