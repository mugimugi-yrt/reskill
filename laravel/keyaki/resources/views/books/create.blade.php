@extends('layouts.app')

@section('content')
<h1>書籍登録</h1>

@include('commons.flash')
<form action="{{ route('books.store') }}" method="post">
    @include('books.form')
    <button type="submit">登録</button>
</form>
@endsection