@extends('layouts.app')
@section('title')
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@endsection
</head>

@section('content')
<body>

    <form action="{{ route('searches.index') }}" method="POST">
        @csrf
        <div>
            <label>予算</label>
            <label for="min_budget">最低</label>
            <input type="number" name="min_budget" id="min_budget" min="0">
            円~
            <label for="max_budget">最高</label>
            <input type="number" name="max_budget" id="max_budget" min="0">
            円
        </div>
        <div>
            <label for="genre">ジャンル</label>
            <input type="text" name="genre" id="genre">
        </div>
        @extends('search.map')
        <div>
            <label for="max_guest">利用人数</label>
            <input type="number" name="max_guest" id="max_guest" min="1">
        </div>

        <div>
            <label for="check_in">チェックイン日時　</label>
            <input type="datetime-local" name="check_in" id="check_in">
        </div>

        <div>
            <label for="check_out">チェックアウト日時　</label>
            <input type="datetime-local" name="check_out" id="check_out">
        </div>

        <div>
            <label>食事</label>
            <label><input type="radio" name="meal" value="" checked> どちらでも可</label>
            <label><input type="radio" name="meal" value="1"> あり</label>
            <label><input type="radio" name="meal" value="0"> なし</label>
        </div>

        <div>
            <label>温泉</label>
            <label><input type="radio" name="hot_spring" value="" checked> どちらでも可</label>
            <label><input type="radio" name="hot_spring" value="1"> あり</label>
            <label><input type="radio" name="hot_spring" value="0"> なし</label>
        </div>

        <div>
            <label for="group_room">団体受け入れ客室数　</label>
            <input type="number" name="group_room" id="group_room" min="0">
        </div>

        <div>
            <label for="favorites">お気に入り数　</label>
            <input type="number" name="favorites" id="favorites" min="0">
        </div>

        <div>
            <label for="stars">星の数　</label>
            <input type="number" name="stars" id="stars" min="1" max="5">
        </div>

        <div>
            <label for="reviews">口コミの数　</label>
            <input type="number" name="reviews" id="reviews" min="0">
        </div>

        <div>
            <label for="sort">ソート条件　</label>
            <select name="sort" id="sort">
                <option value="ランキング順">ランキング順</option>
                <option value="価格が安い順">価格が安い順</option>
                <option value="価格が高い順">価格が高い順</option>
                <option value="星の数が多い順">星の数が多い順</option>
                <option value="口コミ数が多い順">口コミ数が多い順</option>
            </select>
        </div>

        <div>
            <button type="submit">検索</button>
        </div>
    </form>
    

    <img src="/img/map.png" alt=""> <!--本来はmap.blade.php-->
</body>
@endsection