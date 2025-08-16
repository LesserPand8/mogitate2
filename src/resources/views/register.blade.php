@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<main>
    <h1 class="page-title">商品登録</h1>
    <div class="register-container">
        <form action="/products/register" method="POST" enctype="multipart/form-data" class="register-form">
            @csrf
            <!-- 商品名 -->
            <div class="form-name-group">
                <div class="form-name-label-container">
                    <label for="name" class="form-label">
                        商品名
                    </label>
                    <div class="required">必須</div>
                </div>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-input"
                    value="{{ old('name') }}"
                    placeholder="商品名を入力">
                @error('name')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- 価格 -->
            <div class="form-price-group">
                <div class="form-price-label-container">
                    <label for="price" class="form-label">
                        価格
                    </label>
                    <div class="required">必須</div>
                </div>
                <input
                    type="number"
                    id="price"
                    name="price"
                    class="form-input"
                    value="{{ old('price') }}"
                    placeholder="価格を入力">
                @error('price')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- 商品画像 -->
            <div class="form-image-group">
                <div class="form-image-label-container">
                    <label for="image" class="form-label">
                        商品画像
                    </label>
                    <div class="required">必須</div>
                </div>
                <input
                    type="file"
                    id="image"
                    name="image"
                    class="file-input"
                    accept="image/*">
                @error('image')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- 季節 -->
            <div class="form-season-group">
                <div class="form-season-label-container">
                    <label class="form-label">
                        季節
                    </label>
                    <div class="required">必須</div>
                    <div class="multiple">
                        複数選択可
                    </div>
                </div>
                <div class="checkbox-group">
                    <label class="checkbox-item">
                        <input type="checkbox" name="seasons[]" value="春" {{ in_array('春', old('seasons', [])) ? 'checked' : '' }}>
                        <span class="checkbox-label">春</span>
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="seasons[]" value="夏" {{ in_array('夏', old('seasons', [])) ? 'checked' : '' }}>
                        <span class="checkbox-label">夏</span>
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="seasons[]" value="秋" {{ in_array('秋', old('seasons', [])) ? 'checked' : '' }}>
                        <span class="checkbox-label">秋</span>
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="seasons[]" value="冬" {{ in_array('冬', old('seasons', [])) ? 'checked' : '' }}>
                        <span class="checkbox-label">冬</span>
                    </label>
                </div>
                @error('seasons')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>


            <!-- 商品説明 -->
            <div class="form-description-group">
                <div class="form-description-label-container">
                    <label for="description" class="form-label">
                        商品説明
                    </label>
                    <div class="required">必須</div>
                </div>
                <textarea
                    id="description"
                    name="description"
                    class="form-textarea"
                    rows="6"
                    placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                @error('description')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- ボタン -->
            <div class="form-buttons">
                <a href="/products" class="btn-back-container">戻る</a>
                <button type="submit" class="btn-submit-container">登録</button>
            </div>
        </form>
    </div>
</main>
@endsection