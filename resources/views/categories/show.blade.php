@extends('layouts.app')

@section('title', $category->name . ' - TheSPARK')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/editorials.css') }}">
@endpush

@section('content')
<section class="editorials-header">
    <h1>{{ $category->name }}</h1>
</section>

<section class="editorials-content">
    @if($posts->count() > 0)
        <div class="editorials-layout">
            <!-- Featured Article (First/Latest Post) -->
            @if($posts->first())
            <article class="featured-article">
                <div class="featured-image">
                    <span class="article-category">{{ $posts->first()->category->name }}</span>
                    <a href="{{ route('articles.show', $posts->first()->slug) }}">
                        <img src="{{ $posts->first()->thumbnail ? asset('storage/' . $posts->first()->thumbnail) : asset('images/placeholder-article.jpg') }}" alt="{{ $posts->first()->title }}">
                    </a>
                </div>
                <div class="featured-content">
                    <h2>{{ $posts->first()->title }}</h2>
                    <p>{{ Str::limit(strip_tags($posts->first()->description), 150) }}</p>
                    <div class="article-meta">
                        <span class="article-date">{{ \Carbon\Carbon::parse($posts->first()->date)->format('F d, Y') }}</span>
                        <a href="{{ route('articles.show', $posts->first()->slug) }}" class="read-more">Read More</a>
                    </div>
                </div>
            </article>
            @endif
            
            <!-- Grid of Other Articles (Skip first one) -->
            <div class="editorials-grid">
                @foreach($posts->skip(1) as $post)
                <article class="article-card">
                    <div class="article-image">
                        <span class="article-category">{{ $post->category->name }}</span>
                        <a href="{{ route('articles.show', $post->slug) }}">
                            <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('images/placeholder-article.jpg') }}" alt="{{ $post->title }}">
                        </a>
                    </div>
                    <div class="article-content">
                        <h3>{{ Str::limit($post->title, 60) }}</h3>
                        <p>{{ Str::limit(strip_tags($post->description), 100) }}</p>
                        <div class="article-meta">
                            <span class="article-date">{{ \Carbon\Carbon::parse($post->date)->format('F d, Y') }}</span>
                            <a href="{{ route('articles.show', $post->slug) }}" class="read-more">Read More</a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        
        @if($posts->hasMorePages())
            <div style="text-align: center; margin-top: 2rem;">
                {{ $posts->links() }}
            </div>
        @endif
    @else
        <p style="text-align: center; color: #666; padding: 3rem;">No articles found in this category.</p>
    @endif
</section>
@endsection
