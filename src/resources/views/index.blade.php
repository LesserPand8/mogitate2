@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<main>
    <div class="products-header">
        <h1 class="page-title">商品一覧</h1>
        <div class="add-product">
            <a href="/products/register" class="add-btn">+ 商品を追加</a>
        </div>
    </div>
    <div class="products-container">
        <form method="GET" action="/products" class="search-container">
            <div class="search-box">
                <div class="search-box-input">
                    <input type="text" name="keyword" class="search-input" placeholder="商品名で検索" value="{{ request('keyword') }}">
                </div>
                <button type="submit" class="search-btn">
                    <span class="search-btn-text">検索</span>
                </button>
            </div>
            <div class="sort-box">
                <label for="price-sort" class="sort-label">価格順で表示</label>
                <select id="price-sort" name="sort" class="sort-select" onchange="this.form.submit()">
                    <option value="" disabled {{ !request('sort') ? 'selected' : '' }} hidden>価格で並び替え</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>安い順に表示</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
                </select>
            </div>
            @if(request('sort'))
            <div class="sort-tag">
                <span>
                    {{ request('sort') == 'asc' ? '安い順' : '高い順' }}
                </span>
                <a href="{{ url('/products?' . http_build_query(array_merge(request()->except('sort', 'page'))) ) }}" class="sort-reset-btn">×</a>
            </div>
            @endif
        </form>
        <div class="products-list">
            @forelse($products as $product)
            <div class="product-card" onclick="location.href='/products/{{ $product->id }}'">
                <div class="product-image">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                </div>
                <div class="product-info">
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-price">¥{{ number_format($product->price) }}</div>
                </div>
            </div>
            @empty
            <div class="no-products">商品が見つかりませんでした。</div>
            @endforelse
        </div>
        <div class="pagination">
            {{ $products->appends(request()->except('page'))->links() }}
        </div>
    </div>
</main>
@endsection