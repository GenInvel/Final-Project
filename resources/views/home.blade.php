@extends('layouts.app')

@section('title', 'Home - TheSPARK')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<section class="whats-new">
    <h2>What's New</h2>
    <div class="carousel">
        <div class="carousel-track">
            @foreach($carouselPosts as $index => $post)
            <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}">
                <a href="{{ route('articles.show', $post->slug) }}">
                    <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('images/placeholder-article.jpg') }}" alt="{{ $post->title }}">
                    <div class="carousel-caption">
                        <span class="carousel-category">{{ $post->category->name }}</span>
                        <h3>{{ $post->title }}</h3>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="carousel-indicators">
            @foreach($carouselPosts as $index => $post)
            <span class="indicator {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></span>
            @endforeach
        </div>
    </div>
</section>

<section class="popular-now">
    <h2>Popular Now</h2>
    <p class="section-subtitle">The most read from TheSPARK</p>
    
    <div class="articles-grid">
        @foreach($popularPosts as $post)
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
</section>

<section class="published-issues">
    <h2>Published Issues</h2>
    <p class="section-subtitle">Read or get a physical copy from TheSPARK</p>
    
    <div class="issues-grid">
        @foreach($publishedIssues as $post)
        <article class="issue-card">
            <div class="issue-image">
                <span class="issue-category">{{ $post->category->name }}</span>
                <a href="{{ route('articles.show', $post->slug) }}">
                    <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('images/placeholder-article.jpg') }}" alt="{{ $post->title }}">
                </a>
            </div>
            <div class="issue-content">
                <h3>{{ Str::limit($post->title, 60) }}</h3>
                <p>{{ Str::limit(strip_tags($post->description), 100) }}</p>
                <div class="issue-meta">
                    <span class="issue-date">{{ \Carbon\Carbon::parse($post->date)->format('F d, Y') }}</span>
                    <a href="{{ route('articles.show', $post->slug) }}" class="explore-more">Explore Now</a>
                </div>
            </div>
        </article>
        @endforeach
    </div>
</section>

<section class="newsletter">
    <h2>Newsletter</h2>
    <h3>Get Updates</h3>
    <p>Be the first to know about the latest stories, special issues, and publication highlights. Stay connected with insights, features, and updates that matter to the community.</p>
    
    <form class="newsletter-form" action="{{ url('/subscribe') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Enter your email..." required>
        <button type="submit">Subscribe</button>
    </form>
</section>
@endsection
