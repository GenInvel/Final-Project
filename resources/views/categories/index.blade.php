@extends('layouts.app')

@section('title', 'Categories - TheSPARK')

@push('styles')
<style>
    .categories-listing-page {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .page-header {
        text-align: center;
        margin-bottom: 3rem;
        padding: 2rem 0;
    }

    .page-header h1 {
        font-size: 2.5rem;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
    }

    .page-header p {
        color: #666;
        font-size: 1.1rem;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }

    .category-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    }

    .category-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #d32f2f, #b71c1c);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: white;
        font-weight: bold;
    }

    .category-card h3 {
        font-size: 1.5rem;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
    }

    .category-count {
        color: #999;
        font-size: 0.95rem;
    }
</style>
@endpush

@section('content')
<div class="categories-listing-page">
    <div class="page-header">
        <h1>Categories</h1>
        <p>Explore stories by category</p>
    </div>

    <div class="categories-grid">
        @foreach($categories as $category)
        <a href="{{ route('categories.show', $category->slug) }}" class="category-card">
            <div class="category-icon">
                {{ strtoupper(substr($category->name, 0, 1)) }}
            </div>
            <h3>{{ $category->name }}</h3>
            <p class="category-count">{{ $category->posts_count }} {{ Str::plural('article', $category->posts_count) }}</p>
        </a>
        @endforeach
    </div>
</div>
@endsection
