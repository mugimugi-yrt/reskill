@php
    use Carbon\Carbon;
@endphp

@extends('layouts.app')
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <!-- $hotels という変数の中に hotelテーブルすべてのオブジェクトが入ってます -->

    @section('title')
        予約履歴
    @endsection

    @section('css')
        <link rel="stylesheet" href="/css/admin.css">
    @endsection
</head>

@section('content')
<body>
    <h1>予約履歴</h1>
    <!--テーブル繰り返し-->
    @foreach ($reservations as $reservation)
        <table border="1">

            <tr>
                <td rowspan="5"><img src="/img/{{ $plans[$reservation->plan_id - 1]->hotel->image}}" alt="" width="200">
                </td>
                <td>プラン名</td>
                <td>{{ $plans[$reservation->plan_id - 1]->name }}</td>
            </tr>
            <tr>
                <td>ホテル名</td>
                <td>{{ $plans[$reservation->plan_id - 1]->hotel->name }}</td>
            </tr>
            <tr>
                <td>利用期間</td>
                <td>{{ str_replace("T", " ", $reservation->check_in)  }}~{{ str_replace("T", " ", $reservation->check_out) }}
                </td>
            </tr>
            <tr>
                <td>利用人数</td>
                <td>{{ $reservation->num_user }}</td>
            </tr>
            <tr>
                <td>支払金額</td>
                <td>{{ $plans[$reservation->plan_id - 1]->price }}</td>
            </tr>
            <td><button>
                @if(Carbon::parse($reservation->check_out)->lt(Carbon::now()))
                    領収書発行
                @else
                    予約情報変更
                @endif
            </button></td>
        </table>
    @endforeach
    <a href="{{ route("searches.top") }}">プラン検索に戻る</a>
</body>

@endsection