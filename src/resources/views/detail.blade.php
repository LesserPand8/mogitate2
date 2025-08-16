@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<main>
    <div class="detail-container">
        <div class="detail-header">
            <a href="#" class="detail-link">商品一覧 &gt; キウイ</a>
        </div>
        <div class="detail-content">
            <div class="detail-image">
                <img src="" alt="" style="max-width: 300px;">
            </div>
            <div class="detail-info">
                <div class="detail-group">
                    <label>商品名</label>
                    <input type="text" value="キウイ">
                </div>
                <div class="detail-group">
                    <label>値段</label>
                    <input type="text" value="">
                </div>
                <div class="detail-group">
                    <label>季節</label>
                    <label><input type="radio" checked disabled> 春</label>
                    <label><input type="radio" disabled> 夏</label>
                    <label><input type="radio" disabled> 秋</label>
                    <label><input type="radio" disabled> 冬</label>
                </div>
            </div>
        </div>
    </div>
    <div class="detail-description">
        <label>商品説明</label>
        <textarea
            id="description"
            name="description"
            class="form-textarea"
            rows="6"
            placeholder="商品の説明を入力">{{ old('description') }}</textarea>
    </div>
    <div class="detail-buttons">
        <button class="btn-back">戻る</button>
        <button class="btn-save">変更を保存</button>
        <button class="btn-delete">🗑</button>
    </div>
</main>
@endsection