@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<main>
    <div class="detail">
        <h1 class="detail__title">Detail Page</h1>
        <p class="detail__description">This is the detail page description.</p>
    </div>
</main>
@endsection