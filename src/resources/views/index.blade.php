@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<main>
    <div class="products-header">
        <h1 class="page-title">商品一覧</h1>
        <a href="/products/register" class="add-btn">+ 商品を追加</a>
    </div>
    <div class="products-container">
        <form method="GET" action="/products" class="search-container">
            <div class="search-box">
                <input type="text" name="keyword" class="search-input" placeholder="商品名で検索" value="{{ request('keyword') }}">
                <button type="submit" class="search-btn">検索
                </button>
            </div>
            <div class="sort-box">
                <label for="price-sort" class="sort-label">価格順で表示</label>
                <select id="price-sort" name="sort" class="sort-select" onchange="this.form.submit()">
                    <option value="" disabled {{ !request('sort') ? 'selected' : '' }} hidden>価格で並び替え</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>安い順に表示</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
                </select>
                @if(request('sort'))
                <div class="sort-tag">
                    <span>
                        {{ request('sort') == 'asc' ? '安い順に表示' : '高い順に表示' }}
                    </span>
                    <a href="{{ url('/products?' . http_build_query(array_merge(request()->except('sort', 'page'))) ) }}" class="sort-reset-btn">×</a>
                </div>
                @endif
            </div>
        </form>
        <div class="products">
            <div class="products-list">
                @forelse($products as $product)
                <div class="product-card" onclick="location.href='/products/{{ $product->id }}'">
                    <div class="product-image">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
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
                @if ($products->lastPage() > 1)
                {{-- 前へ --}}
                <button class="pagination-arrow" {{ $products->onFirstPage() ? 'disabled' : '' }}
                    onclick="location.href='{{ $products->appends(request()->except('page'))->previousPageUrl() }}'; return false;">
                    &lt;
                </button>
                {{-- ページ番号 --}}
                @for ($i = 1; $i <= $products->lastPage(); $i++)
                    <button class="pagination-btn{{ $i == $products->currentPage() ? ' active' : '' }}"
                        onclick="location.href='{{ $products->appends(request()->except('page'))->url($i) }}'; return false;">
                        {{ $i }}
                    </button>
                    @endfor
                    {{-- 次へ --}}
                    <button class="pagination-arrow" {{ $products->currentPage() == $products->lastPage() ? 'disabled' : '' }}
                        onclick="location.href='{{ $products->appends(request()->except('page'))->nextPageUrl() }}'; return false;">
                        &gt;
                    </button>
                    @endif
            </div>
        </div>
    </div>
</main>
@endsection