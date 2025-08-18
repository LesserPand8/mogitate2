@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

<style>
    main {
        width: 1512px;
        height: 797px;
        padding-top: 70px;
        padding-right: 356px;
        padding-bottom: 70px;
        padding-left: 356px;
        gap: 30px;
        opacity: 1;
        background: #f8f8f8;
    }

    .detail-link {
        text-decoration: none;
    }


    .detail-body {
        display: flex;
    }

    .detail-image {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
        margin-right: 20px;
    }

    .detail-group {
        width: 396px;
        gap: 10px;
        opacity: 1;
        margin-bottom: 10px;
    }

    .name-label {
        font-family: Hiragino Kaku Gothic Pro;
        font-weight: 300;
        font-style: W3;
        font-size: 16px;
        line-height: 100%;
        letter-spacing: 0%;
        color: #4B4B4B;
    }

    .name-input {
        width: 396px;
        height: 43px;
        padding-top: 11px;
        padding-right: 10px;
        padding-bottom: 11px;
        padding-left: 10px;
        gap: 10px;
        opacity: 1;
        border-radius: 5px;
        border-width: 1px;
        background: #FFFFFF;
        border: 1px solid #E0DFDE;
        margin-top: 5px;
        color: #4B4B4B;
    }

    .price-label {
        font-family: Hiragino Kaku Gothic Pro;
        font-weight: 300;
        font-style: W3;
        font-size: 16px;
        line-height: 100%;
        letter-spacing: 0%;
        color: #4B4B4B;
    }

    .price-input {
        width: 396px;
        height: 43px;
        padding-top: 11px;
        padding-right: 10px;
        padding-bottom: 11px;
        padding-left: 10px;
        gap: 10px;
        opacity: 1;
        border-radius: 5px;
        border-width: 1px;
        background: #FFFFFF;
        border: 1px solid #E0DFDE;
        margin-top: 5px;
        color: #4B4B4B;
    }

    .season-label {
        font-family: Hiragino Kaku Gothic Pro;
        font-weight: 300;
        font-style: W3;
        font-size: 16px;
        line-height: 100%;
        letter-spacing: 0%;
        color: #4B4B4B;
    }

    .season-checkboxes {
        width: 314px;
        height: 43;
        padding-top: 4.5px;
        padding-bottom: 4.5px;
        gap: 50px;
        opacity: 1;
        margin-top: 5px;
    }

    .season-checkbox-label {
        margin-right: 20px;
    }


    .detail-description {
        width: 800px;
        height: 194px;
        gap: 10px;
        opacity: 1;
        margin-top: 30px;
    }

    .form-textarea {
        width: 800px;
        height: 160px;
        padding-top: 11px;
        padding-right: 10px;
        padding-bottom: 11px;
        padding-left: 10px;
        gap: 10px;
        opacity: 1;
        border-radius: 5px;
        border-width: 1px;
        background: #FFFFFF;
        border: 1px solid #E0DFDE;
        font-family: Hiragino Kaku Gothic Pro;
        font-weight: 300;
        font-style: W3;
        font-size: 14px;
        line-height: 100%;
        letter-spacing: 0%;
        color: #4B4B4B;
        margin-top: 10px;
    }

    .description-label {
        font-family: Hiragino Kaku Gothic Pro;
        font-weight: 300;
        font-style: W3;
        font-size: 16px;
        line-height: 100%;
        letter-spacing: 0%;
        color: #4B4B4B;
    }

    .detail-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px 0px;
    }

    .btn-back {
        text-decoration: none;
        width: 200px;
        height: 50px;
        padding-top: 13px;
        padding-right: 10px;
        padding-bottom: 13px;
        padding-left: 10px;
        gap: 10px;
        opacity: 1;
        border-radius: 5px;
        background: #E0DFDE;
        margin: 0px 5px;
        color: #4B4B4B;
        font-family: Hiragino Kaku Gothic Pro;
        font-weight: 600;
        font-style: W6;
        font-size: 16px;
        line-height: 100%;
        letter-spacing: 0%;
    }

    .btn-save {
        width: 200px;
        height: 50px;
        padding-top: 13px;
        padding-right: 10px;
        padding-bottom: 13px;
        padding-left: 10px;
        gap: 10px;
        opacity: 1;
        border-radius: 5px;
        background: #F5C800;
        box-shadow: 0px 4px 10px 0px #0000001A;
        margin: 0px 5px;
        color: #4B4B4B;
        font-family: Hiragino Kaku Gothic Pro;
        font-weight: 600;
        font-style: W6;
        font-size: 16px;
        line-height: 100%;
        letter-spacing: 0%;
    }

    .detail-container {
        position: relative;
    }

    .btn-delete-form {
        position: absolute;
        top: 540px;
        right: 0;
    }

    .btn-delete {
        color: #FD0707;
        font-size: 32px;
        /* ここでサイズを調整（例: 32px） */
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
    }

    .error-message {
        color: #FD0707;
        font-family: Hiragino Kaku Gothic Pro;
        font-weight: 300;
        font-style: W3;
        font-size: 14px;
        line-height: 100%;
        letter-spacing: 0%;
    }
</style>

@section('content')
<main>
    <div class="detail-container">

        <form action="/products/{{ $product->id }}/update" method="POST" enctype="multipart/form-data" class="detail-form">
            @csrf
            @method('PUT')
            <div class="detail-content">
                <div class="detail-header">
                    <a href="/products" class="detail-link">商品一覧</a> &gt; {{ $product->name }}
                </div>
                <div class="detail-body">
                    <div class="detail-image">
                        <img id="image-preview" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 300px;">
                        <input type="file" name="image" class="file-input" accept="image/*" onchange="previewImage(event)">
                        @if ($errors->has('image'))
                        <div class="error-message">
                            <ul>
                                @foreach ($errors->get('image') as $message)
                                <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class="detail-info-container">
                        <div class="detail-info">
                            <div class="detail-group">
                                <label class="name-label">商品名</label>
                                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="name-input">
                                @if ($errors->has('name'))
                                <div class="error-message">
                                    <ul>
                                        @foreach ($errors->get('name') as $message)
                                        <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                            <div class="detail-group">
                                <label class="price-label">値段</label>
                                <input type="number" name="price" value="{{ old('price', $product->price) }}" class="price-input">
                                @if ($errors->has('price'))
                                <div class="error-message">
                                    <ul>
                                        @foreach ($errors->get('price') as $message)
                                        <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                            <div class="detail-group">
                                <label class="season-label">季節</label>
                                <div class="season-checkboxes">
                                    {{-- 季節のチェックボックス --}}
                                    @foreach(['春','夏','秋','冬'] as $season)
                                    <label class="season-checkbox-label">
                                        <input type="checkbox" class="season-checkbox" name="seasons[]" value="{{ $season }}"
                                            {{ in_array($season, old('seasons', $product->seasons ? $product->seasons->pluck('name')->toArray() : [])) ? 'checked' : '' }}>
                                        {{ $season }}
                                    </label>
                                    @endforeach
                                </div>
                                @if ($errors->has('seasons'))
                                <div class="error-message">
                                    <ul>
                                        @foreach ($errors->get('seasons') as $message)
                                        <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail-description">
                <label class="description-label">商品説明</label>
                <textarea
                    id="description"
                    name="description"
                    class="form-textarea"
                    rows="6"
                    placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
                @if ($errors->has('description'))
                <div class="error-message">
                    <ul>
                        @foreach ($errors->get('description') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="detail-buttons">
                <a href="/products" class="btn-back">戻る</a>
                <button type="submit" class="btn-save">変更を保存</button>
            </div>
        </form>
        <form action="/products/{{ $product->id }}/delete" method="POST" class="btn-delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete" onclick="return confirm('本当に削除しますか？')">🗑</button>
        </form>
    </div>
    </div>
</main>


@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection