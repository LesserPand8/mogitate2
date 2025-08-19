@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

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