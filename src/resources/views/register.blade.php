@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<main>
    <div class="register-page">
        <h1 class="page-title">商品登録</h1>
        <!-- <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">商品説明</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">価格</label>
            <input type="number" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="image">画像</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn">登録</button>
    </form> -->
    </div>
</main>
@endsection