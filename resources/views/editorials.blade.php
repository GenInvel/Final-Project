@extends('layouts.app')

@section('title', 'Editorials - TheSPARK')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/editorials.css') }}">
@endpush

@section('content')
<section class="editorials-header">
    <h1>Editorials</h1>
</section>

<section class="editorials-content">
    <div class="editorials-layout">
        <article class="featured-article">
            <div class="featured-image">
                <span class="article-category">News</span>
                <img src="{{ asset('images/placeholder-article.jpg') }}" alt="Featured Article">
            </div>
            <div class="featured-content">
                <h2>The Headline</h2>
                <p>The body of the article should open with small, captivating story or a personal anecdote.</p>
                <div class="article-meta">
                    <span class="article-date">September 13, 2025</span>
                    <a href="{{ url('/articles/1') }}" class="read-more">Read More</a>
                </div>
            </div>
        </article>
        
        <div class="editorials-grid">
            @for($i = 0; $i < 8; $i++)
            <article class="article-card">
                <div class="article-image">
                    <span class="article-category">News</span>
                    <img src="{{ asset('images/placeholder-article.jpg') }}" alt="Article">
                </div>
                <div class="article-content">
                    <h3>The Headline</h3>
                    <p>The body of the article should open with small, captivating story or a personal anecdote.</p>
                    <div class="article-meta">
                        <span class="article-date">September 13, 2025</span>
                        <a href="{{ url('/articles/1') }}" class="read-more">Read More</a>
                    </div>
                </div>
            </article>
            @endfor
        </div>
    </div>
    
    <button class="load-more">Load More</button>
</section>
@endsection