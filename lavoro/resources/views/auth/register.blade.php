<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>新規会員登録</title>
</head>

<body>
    <h2>新規会員登録</h2>
    @include('commons.flash')
    <form action="{{ route('users.create.check') }}" method="post">
        @csrf
        <p>
            <label>氏名</label>
            <input type="text" name="last_name" placeholder="例) 田中" value="{{ old('last_name') }}">
            <input type="text" name="first_name" placeholder="例) 太郎" value="{{ old('first_name') }}">
        </p>
        <p>
            <label>フリガナ</label>
            <input type="text" name="last_ruby" placeholder="例) タナカ" value="{{ old('last_ruby') }}">
            <input type="text" name="first_ruby" placeholder="例) タロウ" value="{{ old('first_ruby') }}">
        </p>
        <p>
            <label>パスワード</label>
            <input type="password" name="password">
        </p>
        <p>
            <label>パスワード（確認用）</label>
            <input type="password" name="password_confirmation">
        </p>
        <p>
            <label>メールアドレス</label>
            <input type="email" name="email" placeholder="例) tanaka@example.com" value="{{ old('email') }}">
        </p>
        <p>
            <!-- 実はこれリスキルの電話番号 -->
            <label>電話番号</label>
            <input type="text" name="tel" placeholder="05055302815" value="{{ old('tel') }}">※ハイフンを入れないでください
        </p>
        
        <p>
            <label>会社名<label>
            <input type="text" name="company" placeholder="例) リスキル株式会社" value="{{ old('company') }}">
        </p>
        <p>
            <label>生年月日</label>
            <input type="date" name="birthday" value="{{ old('birthday') }}">
        </p>
        <p>
            <label>住所</label>
            郵便番号：〒<input type="text" name="address_post" placeholder="000-0000" value="{{ old('address_post') }}">※半角数字（ハイフンを含む）<br>
            都道府県：<select name="address_pref">
                        <!-- selected は次回 -->
                        <option value="">選択してください</option>
                        <script>
                            const prefectures = [
                                "北海道", "青森県", "岩手県", "宮城県", "秋田県", "山形県", "福島県",
                                "茨城県", "栃木県", "群馬県", "埼玉県", "千葉県", "東京都", "神奈川県",
                                "新潟県", "富山県", "石川県", "福井県", "山梨県", "長野県",
                                "岐阜県", "静岡県", "愛知県", "三重県",
                                "滋賀県", "京都府", "大阪府", "兵庫県", "奈良県", "和歌山県",
                                "鳥取県", "島根県", "岡山県", "広島県", "山口県",
                                "徳島県", "香川県", "愛媛県", "高知県",
                                "福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"
                            ];
                            for (const pref of prefectures) {
                                document.write(`<option value="${pref}">${pref}</option>`);
                            }
                        </script>
                    </select> <br>
            市区町村：<input type="text" name="address_town" placeholder="新宿区四谷" value="{{ old('address_town') }}"> <br>
            丁目番地号：<input type="text" name="address_street" placeholder="４－２８－４"value="{{ old('address_street') }}">※全角（ハイフンを含む）<br>
            マンション名・部屋番号等：<input type="text" name="address_num" placeholder="ＹＫＢエンサインビル 10F"value="{{ old('address_num') }}">
        </p>
        <p>
            <label>性別</label>
            <input type="radio" name="gender" value="回答しない" checked>回答しない
            <input type="radio" name="gender" value="男">男
            <input type="radio" name="gender" value="女">女
        </p>
        <p>
            <label>お知らせ配信</label>
            <!-- 1 = true -->
            <input type="radio" name="get_notice" value="1" checked>受け取る
            <!-- 0 = false -->
            <input type="radio" name="get_notice" value="0">受け取らない
        </p>
        <p>
            <button type="submit">確認画面へ</button>
        </p>
    </form>
    <p>
        <a href="{{ route('login') }}">ログイン画面に戻る</a><!-- ユーザーログイン画面へ戻る -->
    </p>
</body>

</html>