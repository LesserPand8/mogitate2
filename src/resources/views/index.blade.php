@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<main>
    <div class="products-header">
        <h1 class="page-title">商品一覧</h1>
        <div class="add-product">
            <a href="{{ url('/products/register') }}" class="add-btn">+ 商品を追加</a>
        </div>
    </div>
</main>
@endsection