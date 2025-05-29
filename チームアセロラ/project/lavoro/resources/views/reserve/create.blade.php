
@extends('layouts.app')
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
<!-- $hotels という変数の中に hotelテーブルすべてのオブジェクトが入ってます -->

@section('title')
予約情報入力
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@endsection
</head>

@section('content')
<body>
    <h1>予約情報入力</h1>
    <table border="1">
        <tr>
            <td>プラン名</td>
            <td>{{ $plan->name }}</td>
        </tr>
        <tr>
            <td>ホテル名</td>
            <td>{{ $plan->hotel->name }}</td>
        </tr>
        <tr>
            <td>料金(１泊につき)</td>
            <td>{{ $plan->price }}円</td>
        </tr>
    </table>
    <form action="{{ route("reservations.create.check") }}" method="post">
        @csrf
        <p>
            <label>チェックイン日時</label>

            <input type="datetime-local" name="check_in">
        </p>
        <p>
            <label>チェックアウト日時</label>
            <input type="datetime-local" name="check_out">
        </p>
        <p>
            <label>利用人数</label>
            <input type="text" name="num_user">人
        </p>
        
        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
        <input type="hidden" name="hotel_id" value="{{ $plan->hotel->id }}">
        <input type="hidden" name="price" value="{{ $plan->price }}">
        <input type="hidden" name="reservation" value="{{ $reservation }}">
        <input type="hidden" name="is_deleted" value="0">
        <button type="submit">確認画面へ</button>
    </form>
    <a href="">戻る</a>
</body>
@endsection