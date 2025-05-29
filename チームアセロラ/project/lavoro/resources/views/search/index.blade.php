@extends('layouts.app')
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!-- $hotels という変数の中に hotelテーブルすべてのオブジェクトが入ってます -->

    @section('title')
    @endsection

    @section('css')
        <link rel="stylesheet" href="/css/admin.css">
    @endsection
</head>

@section('content')

    <body>
        <div>
            <p>
                <span>{{ $min_budget ? $min_budget . "円" : '0円' }}</span>
                ～
                <span>{{ $max_budget ? $max_budget . "円" : '' }}</span>
            </p>
            <p>利用人数：{{ $max_guest }}人</p>
            <p>{{ $meal ? "食事あり" : "食事: どちらでも可" }}</p>
            <p>{{ $hot_spring ? "温泉あり" : "温泉: どちらでも可" }}</p>
            <p>{{ $sort }}</p><br>
            <hr>
            @foreach ($data as $column)
                <div name="plan-component">
                    <a
                        href="{{ route('searches.plans.show', ['id' => $column->id]) }}">プラン名:{{ $column->name}}</a><br>
                    <img src="/img/{{ $column->hotel->image }}" width="200">
                    <p>{{ $column->hotel->name }}</p>
                    <p>{{ $column->hotel->address }}</p>
                    <p>最大利用人数: {{ $column->max_guest }}</p>
                    <p>お気に入り数: {{ isset($num_likes[$column->hotel->id]) ? $num_likes[$column->hotel->id] : 0 }}</p>
                    <p>口コミ数: {{ $column->hotel->cnt_contents ? $column->hotel->cnt_contents : 0}}</p>
                    <p>値段: {{ $column->price }}</p>
                    <p>星数: {{ $column->hotel->sum_stars }}</p>
                </div>
            @endforeach
        </div>
    </body>
@endsection