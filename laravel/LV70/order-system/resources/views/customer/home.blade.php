@extends('layout.app')

@section('content')
<div class="title">顧客管理</div>
<main>
    @include('customer.table')
</main>
@endsection