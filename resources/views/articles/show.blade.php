@extends('layouts.app')

@section('title', $post->title . ' - TheSPARK')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/articles.css') }}">
@endpush

@section('content')
<div class="article-page">
    <div class="article-container">
        <div class="article-main">
            <div class="article-header">
                <span class="article-category">{{ $post->category->name }}</span>
                <span class="article-date">{{ \Carbon\Carbon::parse($post->date)->format('F d, Y') }}</span>
            </div>
            
            <h1 class="article-title">{{ $post->title }}</h1>
            
            <div class="article-share">
                <span>Share</span>
                <div class="share-buttons">
                    <button class="share-btn facebook" title="Share on Facebook" onclick="shareOnFacebook()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </button>
                    <button class="share-btn threads" title="Share on Threads" onclick="shareOnThreads()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 14.586c-.37 1.516-1.754 2.656-3.294 2.656-1.54 0-2.924-1.14-3.294-2.656h6.588z"/>
                        </svg>
                    </button>
                    <button class="share-btn twitter" title="Share on Twitter" onclick="shareOnTwitter()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </button>
                    <button class="share-btn email" title="Share via Email" onclick="shareViaEmail()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            @auth
            <button class="favorite-btn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
                Add to Favorites
            </button>
            @endauth
            
            <div class="article-featured-image">
                <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('images/placeholder-article.jpg') }}" alt="{{ $post->title }}">
            </div>
            @if($post->photojournalist)
            <p class="image-credit"><i>photos by {{ $post->photojournalist->full_name }}/TheSPARK</i></p>
            @endif

            <div class="article-body">
                {!! $post->description !!}
            </div>
            
            <div class="article-author">
                <h3>Written by:</h3>
                <div class="author-card">
                    <img src="{{ $post->author->photo ? asset('storage/' . $post->author->photo) : asset('images/default-avatar.png') }}" alt="{{ $post->author->full_name }}" class="author-avatar">
                    <div class="author-info">
                        <h4>{{ $post->author->full_name }}</h4>
                        <p class="author-position">{{ $post->author->position }}</p>
                        <p class="author-email">{{ $post->author->cspc_email }}</p>
                    </div>
                </div>
            </div>
            
            <div class="article-comments">
                <h3>Comments</h3>
                @auth
                <form class="comment-form">
                    <input type="text" placeholder="Share your insights..." class="comment-input">
                    <button type="submit" class="comment-btn">Comment</button>
                </form>
                @else
                <p class="comment-login-prompt">Please <a href="#" onclick="openAuthModal()">log in</a> to comment.</p>
                @endauth
            </div>
            
            <section class="related-posts">
                <h2>Related Posts</h2>
                <p class="section-subtitle">You might like to read these posts</p>
                
                <div class="related-grid">
                    @foreach($relatedPosts as $relatedPost)
                    <article class="article-card">
                        <div class="article-image">
                            <span class="article-category">{{ $relatedPost->category->name }}</span>
                            <a href="{{ route('articles.show', $relatedPost->slug) }}">
                                <img src="{{ $relatedPost->thumbnail ? asset('storage/' . $relatedPost->thumbnail) : asset('images/placeholder-article.jpg') }}" alt="{{ $relatedPost->title }}">
                            </a>
                        </div>
                        <div class="article-content">
                            <h3>{{ Str::limit($relatedPost->title, 60) }}</h3>
                            <p>{{ Str::limit(strip_tags($relatedPost->description), 100) }}</p>
                            <div class="article-meta">
                                <span class="article-date">{{ \Carbon\Carbon::parse($relatedPost->date)->format('F d, Y') }}</span>
                                <a href="{{ route('articles.show', $relatedPost->slug) }}" class="read-more">Read More</a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </section>
        </div>
        
        <aside class="article-sidebar">
            <div class="sidebar-section">
                <h3>Top Stories</h3>
                <p class="sidebar-subtitle">You might like to read these posts</p>
                
                <div class="top-stories">
                    @foreach($topStories as $index => $story)
                    <article class="top-story">
                        <div class="top-story-image">
                            <span class="article-category">{{ $story->category->name }}</span>
                            <a href="{{ route('articles.show', $story->slug) }}">
                                <img src="{{ $story->thumbnail ? asset('storage/' . $story->thumbnail) : asset('images/placeholder-article.jpg') }}" alt="{{ $story->title }}">
                            </a>
                        </div>
                        <div class="top-story-content">
                            <span class="story-number">0{{ $index + 1 }}</span>
                            <h4>{{ Str::limit($story->title, 50) }}</h4>
                            <p>{{ Str::limit(strip_tags($story->description), 80) }}</p>
                            <div class="story-meta">
                                <span class="story-date">{{ \Carbon\Carbon::parse($story->date)->format('F d, Y') }}</span>
                                <a href="{{ route('articles.show', $story->slug) }}" class="read-more">Read More</a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            
            <div class="sidebar-section">
                <h3>Categories</h3>
                <div class="category-tags">
                    @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category->slug) }}" class="category-tag">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
    
    <button class="back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
        Back to Top →
    </button>
</div>

@push('scripts')
<script>
function shareOnFacebook() {
    window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href), '_blank', 'width=600,height=400');
}

function shareOnTwitter() {
    window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(window.location.href) + '&text=' + encodeURIComponent('{{ $post->title }}'), '_blank', 'width=600,height=400');
}

function shareOnThreads() {
    window.open('https://www.threads.net/intent/post?text=' + encodeURIComponent('{{ $post->title }} ' + window.location.href), '_blank', 'width=600,height=400');
}

function shareViaEmail() {
    window.location.href = 'mailto:?subject=' + encodeURIComponent('{{ $post->title }}') + '&body=' + encodeURIComponent(window.location.href);
}
</script>
@endpush
@endsection
