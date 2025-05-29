@extends('layouts.app')

@section('content')
<h1>マイページ</h1>
<p><a href="{{ route('books.create') }}"> + 書籍登録</a></p>
@include('commons.books')
@endsection